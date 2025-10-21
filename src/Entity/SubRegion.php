<?php

declare(strict_types=1);

namespace App\Entity;

use App\Form\SubRegionType;
use App\Grid\SubRegionGrid;
use App\Repository\SubRegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\BulkDelete;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Update;

#[AsResource(
    section: 'admin',
    formType: SubRegionType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Index(grid: SubRegionGrid::class),
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
    ],
)]
#[ORM\Entity(repositoryClass: SubRegionRepository::class)]
class SubRegion implements ResourceInterface, \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $wikiDataId = null;

    #[ORM\ManyToOne(inversedBy: 'subRegions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $region_id = null;

    /**
     * @var Collection<int, Country>
     */
    #[ORM\OneToMany(targetEntity: Country::class, mappedBy: 'subregion_id')]
    private Collection $countries;

    public function __construct()
    {
        $this->countries = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWikiDataId(): ?string
    {
        return $this->wikiDataId;
    }

    public function setWikiDataId(string $wikiDataId): static
    {
        $this->wikiDataId = $wikiDataId;

        return $this;
    }

    public function getRegionId(): ?Region
    {
        return $this->region_id;
    }

    public function setRegionId(?Region $region_id): static
    {
        $this->region_id = $region_id;

        return $this;
    }

    /**
     * @return Collection<int, Country>
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): static
    {
        if (!$this->countries->contains($country)) {
            $this->countries->add($country);
            $country->setSubregionId($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): static
    {
        // set the owning side to null (unless already changed)
        if ($this->countries->removeElement($country) && $country->getSubregionId() === $this) {
            $country->setSubregionId(null);
        }

        return $this;
    }
}
