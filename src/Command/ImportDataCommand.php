<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Region;
use App\Entity\SubRegion;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use App\Repository\RegionRepository;
use App\Repository\SubRegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
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
        private readonly CountryRepository $countryRepository,
        private readonly CityRepository $cityRepository,
        private readonly EntityManagerInterface $manager,
    ) {
    }

    public function __invoke(SymfonyStyle $io): int
    {
        // Regions
        $csv = Reader::from(__DIR__.'/../../data/regions.csv');
        $csv->setHeaderOffset(0);

        $io->title('Importing Regions');
        $io->progressStart($csv->count());

        foreach ($csv->sorted(fn ($a, $b) => (int) $a['id'] <=> (int) $b['id'])->getRecords() as $record) {
            $region = $this->regionRepository->find((int) $record['id']);
            if (!$region instanceof Region) {
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
        $csv = Reader::from(__DIR__.'/../../data/subregions.csv');
        $csv->setHeaderOffset(0);

        $io->title('Importing SubRegions');
        $io->progressStart($csv->count());

        foreach ($csv->sorted(fn ($a, $b) => (int) $a['id'] <=> (int) $b['id'])->getRecords() as $record) {
            $subregion = $this->subRegionRepository->find((int) $record['id']);
            if (!$subregion instanceof SubRegion) {
                $subregion = new SubRegion();
                $this->manager->persist($subregion);
            }

            $subregion->setName($record['name']);
            if ('' !== $record['region_id']) {
                $subregion->setRegionId($this->regionRepository->find((int) $record['region_id']));
            }
            $subregion->setWikiDataId($record['wikiDataId']);
            $io->progressAdvance();
        }

        $this->manager->flush();
        $this->manager->clear();
        $io->progressFinish();

        // Countries
        $csv = Reader::from(__DIR__.'/../../data/countries.csv');
        $csv->setHeaderOffset(0);

        $io->title('Importing Countries');
        $io->progressStart(\count($csv));

        foreach ($csv->sorted(fn ($a, $b) => (int) $a['id'] <=> (int) $b['id'])->getRecords() as $record) {
            $country = $this->countryRepository->find((int) $record['id']);
            if (!$country instanceof Country) {
                $country = new Country();
                $this->manager->persist($country);
            }

            $country->setName($record['name']);
            $country->setIso3($record['iso3']);
            $country->setIso2($record['iso2']);
            $country->setNumericCode($record['numeric_code']);
            $country->setPhonecode($record['phonecode']);
            $country->setCapital($record['capital']);
            $country->setCurrency($record['currency']);
            $country->setCurrencyName($record['currency_name']);
            $country->setCurrencySymbol($record['currency_symbol']);
            $country->setTld($record['tld']);
            $country->setNative($record['native']);
            $country->setPopulation($record['population']);
            $country->setGdp($record['gdp']);
            $country->setRegion($record['region']);
            if ('' !== $record['region_id']) {
                $country->setRegionId($this->regionRepository->find((int) $record['region_id']));
            }
            $country->setSubregion($record['subregion']);
            if ('' !== $record['subregion_id']) {
                $country->setSubregionId($this->subRegionRepository->find((int) $record['subregion_id']));
            }
            $country->setNationality($record['nationality']);
            $country->setTimezones($this->convertCustomStringToArray($record['timezones']));
            $country->setLatitude($record['latitude']);
            $country->setLongitude($record['longitude']);
            $country->setEmoji($record['emoji']);
            $country->setEmojiU($record['emojiU']);
            $country->setWikiDataId($record['wikiDataId']);

            $io->progressAdvance();
        }

        $this->manager->flush();
        $this->manager->clear();
        $io->progressFinish();

        // Cities
        $csv = Reader::from(__DIR__.'/../../data/cities.csv');
        $csv->setHeaderOffset(0);

        $io->title('Importing Cities');
        $io->progressStart(\count($csv));

        foreach ($csv->sorted(fn ($a, $b) => (int) $a['id'] <=> (int) $b['id'])->getRecords() as $record) {
            $city = $this->cityRepository->find((int) $record['id']);
            if (!$city instanceof City) {
                $city = new City();
                $this->manager->persist($city);
            }

            $city->setName($record['name']);
            $city->setStateId($record['state_id']);
            $city->setStateCode($record['state_code']);
            $city->setStateName($record['state_name']);
            if ('' !== $record['country_id']) {
                $city->setCountryId($this->countryRepository->find((int) $record['country_id']));
            }
            $city->setCountryCode($record['country_code']);
            $city->setCountryName($record['country_name']);
            $city->setLatitude($record['latitude']);
            $city->setLongitude($record['longitude']);
            $city->setNative($record['native']);
            $city->setTimezone($record['timezone']);
            $city->setWikiDataId($record['wikiDataId']);

            $io->progressAdvance();
        }

        $this->manager->flush();
        $this->manager->clear();
        $io->progressFinish();

        return Command::SUCCESS;
    }

    private function convertCustomStringToArray(string $str): array
    {
        $result = [];

        // Remove the outer brackets
        $str = trim($str, '[]');

        // Split objects by '},{' but keep inner content intact
        $objects = preg_split('/\},\s*\{/', $str);

        foreach ($objects as $obj) {
            // Add braces back
            $obj = '{'.trim($obj, '{}').'}';

            // Match key:value pairs
            preg_match_all('/(\w+):([^\s,}]+)/', $obj, $matches, \PREG_SET_ORDER);

            $assoc = [];
            foreach ($matches as $match) {
                $key = $match[1];
                $value = $match[2];

                // Remove single or double quotes from string values
                $value = trim($value, '\'"');

                // Convert numeric strings to int
                if (is_numeric($value)) {
                    $value = 0 + $value;
                }

                $assoc[$key] = $value;
            }

            $result[] = $assoc;
        }

        return $result;
    }
}
