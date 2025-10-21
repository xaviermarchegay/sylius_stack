<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
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
