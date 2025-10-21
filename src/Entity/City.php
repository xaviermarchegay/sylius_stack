<?php

declare(strict_types=1);

namespace App\Entity;

use App\Form\CityType;
use App\Grid\CityGrid;
use App\Repository\CityRepository;
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
    formType: CityType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Index(grid: CityGrid::class),
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
    ],
)]
#[ORM\Entity(repositoryClass: CityRepository::class)]
class City implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state_name = null;

    #[ORM\ManyToOne(inversedBy: 'cities')]
    private ?Country $country_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $native = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $timezone = null;

    #[ORM\Column(length: 255)]
    private ?string $wikiDataId = null;

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

    public function getStateId(): ?string
    {
        return $this->state_id;
    }

    public function setStateId(?string $state_id): static
    {
        $this->state_id = $state_id;

        return $this;
    }

    public function getStateCode(): ?string
    {
        return $this->state_code;
    }

    public function setStateCode(?string $state_code): static
    {
        $this->state_code = $state_code;

        return $this;
    }

    public function getStateName(): ?string
    {
        return $this->state_name;
    }

    public function setStateName(?string $state_name): static
    {
        $this->state_name = $state_name;

        return $this;
    }

    public function getCountryId(): ?Country
    {
        return $this->country_id;
    }

    public function setCountryId(?Country $country_id): static
    {
        $this->country_id = $country_id;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(?string $country_code): static
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getCountryName(): ?string
    {
        return $this->country_name;
    }

    public function setCountryName(?string $country_name): static
    {
        $this->country_name = $country_name;

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

    public function getNative(): ?string
    {
        return $this->native;
    }

    public function setNative(?string $native): static
    {
        $this->native = $native;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(?string $timezone): static
    {
        $this->timezone = $timezone;

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
}
