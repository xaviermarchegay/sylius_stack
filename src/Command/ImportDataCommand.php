<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Region;
use App\Entity\SubRegion;
use App\Repository\RegionRepository;
use App\Repository\SubRegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use League\Csv\Statement;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import-data',
    description: 'Import a lot of sample data',
)]
class ImportDataCommand
{
    public function __construct(
        private readonly RegionRepository $regionRepository,
        private readonly SubRegionRepository $subRegionRepository,
        private readonly EntityManagerInterface $manager,
    )
    {
    }

    public function __invoke(SymfonyStyle $io): int
    {
        // Regions
        $csv = Reader::from(__DIR__ . '/../../data/regions.csv');
        $csv->setHeaderOffset(0);

        $io->title('Importing Regions');
        $io->progressStart($csv->count());

        foreach ($csv->sorted(fn($a, $b) => (int)$a['id'] <=> (int)$b['id'])->getRecords() as $record) {
            $region = $this->regionRepository->find((int) $record['id']);
            if (!$region) {
                $region = new Region();
                $this->manager->persist($region);
            }

            $region->setName($record['name']);
            $region->setWikiDataId($record['wikiDataId']);
            $io->progressAdvance();
        }

        $this->manager->flush();
        $this->manager->clear();
        $io->progressFinish();

        // Subregions
        $csv = Reader::from(__DIR__ . '/../../data/subregions.csv');
        $csv->setHeaderOffset(0);

        $io->title('Importing SubRegions');
        $io->progressStart($csv->count());

        foreach ($csv->sorted(fn($a, $b) => (int)$a['id'] <=> (int)$b['id'])->getRecords() as $record) {
            $subregion = $this->subRegionRepository->find((int) $record['id']);
            if (!$subregion) {
                $subregion = new SubRegion();
                $this->manager->persist($subregion);
            }

            $subregion->setName($record['name']);
            $subregion->setRegionId($this->regionRepository->find((int) $record['region_id']));
            $subregion->setWikiDataId($record['wikiDataId']);
            $io->progressAdvance();
        }

        $this->manager->flush();
        $this->manager->clear();
        $io->progressFinish();


        return Command::SUCCESS;
    }
}
