<?php

declare(strict_types=1);

namespace App\Entity;

use App\Form\CountryType;
use App\Grid\CountryGrid;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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
    formType: CountryType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Index(grid: CountryGrid::class),
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
    ],
)]
#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $iso3 = null;

    #[ORM\Column(length: 255)]
    private ?string $iso2 = null;

    #[ORM\Column(length: 255)]
    private ?string $numeric_code = null;

    #[ORM\Column(length: 255)]
    private ?string $phonecode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capital = null;

    #[ORM\Column(length: 255)]
    private ?string $currency = null;

    #[ORM\Column(length: 255)]
    private ?string $currency_name = null;

    #[ORM\Column(length: 255)]
    private ?string $currency_symbol = null;

    #[ORM\Column(length: 255)]
    private ?string $tld = null;

    #[ORM\Column(length: 255)]
    private ?string $native = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $population = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gdp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\ManyToOne(inversedBy: 'countries')]
    private ?Region $region_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subregion = null;

    #[ORM\ManyToOne(inversedBy: 'countries')]
    private ?SubRegion $subregion_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $timezones = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emoji = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emojiU = null;

    #[ORM\Column(length: 255)]
    private ?string $wikiDataId = null;

    /**
     * @var Collection<int, City>
     */
    #[ORM\OneToMany(targetEntity: City::class, mappedBy: 'country_id')]
    private Collection $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
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

    public function getIso3(): ?string
    {
        return $this->iso3;
    }

    public function setIso3(string $iso3): static
    {
        $this->iso3 = $iso3;

        return $this;
    }

    public function getIso2(): ?string
    {
        return $this->iso2;
    }

    public function setIso2(string $iso2): static
    {
        $this->iso2 = $iso2;

        return $this;
    }

    public function getNumericCode(): ?string
    {
        return $this->numeric_code;
    }

    public function setNumericCode(string $numeric_code): static
    {
        $this->numeric_code = $numeric_code;

        return $this;
    }

    public function getPhonecode(): ?string
    {
        return $this->phonecode;
    }

    public function setPhonecode(string $phonecode): static
    {
        $this->phonecode = $phonecode;

        return $this;
    }

    public function getCapital(): ?string
    {
        return $this->capital;
    }

    public function setCapital(?string $capital): static
    {
        $this->capital = $capital;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrencyName(): ?string
    {
        return $this->currency_name;
    }

    public function setCurrencyName(string $currency_name): static
    {
        $this->currency_name = $currency_name;

        return $this;
    }

    public function getCurrencySymbol(): ?string
    {
        return $this->currency_symbol;
    }

    public function setCurrencySymbol(string $currency_symbol): static
    {
        $this->currency_symbol = $currency_symbol;

        return $this;
    }

    public function getTld(): ?string
    {
        return $this->tld;
    }

    public function setTld(string $tld): static
    {
        $this->tld = $tld;

        return $this;
    }

    public function getNative(): ?string
    {
        return $this->native;
    }

    public function setNative(string $native): static
    {
        $this->native = $native;

        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }

    public function setPopulation(?string $population): static
    {
        $this->population = $population;

        return $this;
    }

    public function getGdp(): ?string
    {
        return $this->gdp;
    }

    public function setGdp(?string $gdp): static
    {
        $this->gdp = $gdp;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): static
    {
        $this->region = $region;

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

    public function getSubregion(): ?string
    {
        return $this->subregion;
    }

    public function setSubregion(?string $subregion): static
    {
        $this->subregion = $subregion;

        return $this;
    }

    public function getSubregionId(): ?SubRegion
    {
        return $this->subregion_id;
    }

    public function setSubregionId(?SubRegion $subregion_id): static
    {
        $this->subregion_id = $subregion_id;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getTimezones(): ?string
    {
        return $this->timezones;
    }

    public function setTimezones(?string $timezones): static
    {
        $this->timezones = $timezones;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    public function setEmoji(?string $emoji): static
    {
        $this->emoji = $emoji;

        return $this;
    }

    public function getEmojiU(): ?string
    {
        return $this->emojiU;
    }

    public function setEmojiU(?string $emojiU): static
    {
        $this->emojiU = $emojiU;

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
     * @return Collection<int, City>
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): static
    {
        if (!$this->cities->contains($city)) {
            $this->cities->add($city);
            $city->setCountryId($this);
        }

        return $this;
    }

    public function removeCity(City $city): static
    {
        // set the owning side to null (unless already changed)
        if ($this->cities->removeElement($city) && $city->getCountryId() === $this) {
            $city->setCountryId(null);
        }

        return $this;
    }
}
