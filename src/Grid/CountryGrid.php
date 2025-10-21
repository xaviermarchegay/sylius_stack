<?php

namespace App\Grid;

use App\Entity\Country;
use App\Entity\Region;
use App\Entity\SubRegion;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Filter\EntityFilter;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Component\Grid\Attribute\AsGrid;

#[AsGrid(
    resourceClass: Country::class,
    name: 'app_country',
)]
final class CountryGrid extends AbstractGrid
{
    public function __construct()
    {
        // TODO inject services if required
    }

    public function __invoke(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            // see https://github.com/Sylius/SyliusGridBundle/blob/master/docs/field_types.md
            ->addField(
                StringField::create('name')
                    ->setLabel('Name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('iso3')
                    ->setLabel('Iso3')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('capital')
                    ->setLabel('Capital')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('currency')
                    ->setLabel('Currency')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('region')
                    ->setLabel('Region')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('subregion')
                    ->setLabel('Subregion')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('latitude')
                    ->setLabel('Latitude')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('longitude')
                    ->setLabel('Longitude')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('wikiDataId')
                    ->setLabel('WikiDataId')
                    ->setSortable(true)
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    // ShowAction::create(),
                    UpdateAction::create(),
                    DeleteAction::create()
                )
            )
            ->addActionGroup(
                BulkActionGroup::create(
                    DeleteAction::create()
                )
            )
            ->addFilter(
                EntityFilter::create('region_id', Region::class)
                    ->setLabel('app.ui.region')
            )
            ->addFilter(
                EntityFilter::create('subregion_id', SubRegion::class)
                    ->setLabel('app.ui.sub_region')
            )
        ;
    }
}
