<?php

declare(strict_types=1);

namespace App\Entity;

use App\Form\RegionType;
use App\Grid\RegionGrid;
use App\Repository\RegionRepository;
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
    formType: RegionType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Index(grid: RegionGrid::class),
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
    ],
)]
#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region implements ResourceInterface, \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $wikiDataId = null;

    /**
     * @var Collection<int, SubRegion>
     */
    #[ORM\OneToMany(targetEntity: SubRegion::class, mappedBy: 'region_id', orphanRemoval: true)]
    private Collection $subRegions;

    /**
     * @var Collection<int, Country>
     */
    #[ORM\OneToMany(targetEntity: Country::class, mappedBy: 'region_id')]
    private Collection $countries;

    public function __construct()
    {
        $this->subRegions = new ArrayCollection();
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

    /**
     * @return Collection<int, SubRegion>
     */
    public function getSubRegions(): Collection
    {
        return $this->subRegions;
    }

    public function addSubRegion(SubRegion $subRegion): static
    {
        if (!$this->subRegions->contains($subRegion)) {
            $this->subRegions->add($subRegion);
            $subRegion->setRegionId($this);
        }

        return $this;
    }

    public function removeSubRegion(SubRegion $subRegion): static
    {
        // set the owning side to null (unless already changed)
        if ($this->subRegions->removeElement($subRegion) && $subRegion->getRegionId() === $this) {
            $subRegion->setRegionId(null);
        }

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
            $country->setRegionId($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): static
    {
        // set the owning side to null (unless already changed)
        if ($this->countries->removeElement($country) && $country->getRegionId() === $this) {
            $country->setRegionId(null);
        }

        return $this;
    }
}
