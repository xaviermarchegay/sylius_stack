<?php

namespace App\Grid;

use App\Entity\City;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Component\Grid\Attribute\AsGrid;

#[AsGrid(
    resourceClass: City::class,
    name: 'app_city',
)]
final class CityGrid extends AbstractGrid
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
                StringField::create('state_id')
                    ->setLabel('State_id')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('state_code')
                    ->setLabel('State_code')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('state_name')
                    ->setLabel('State_name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('country_code')
                    ->setLabel('Country_code')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('country_name')
                    ->setLabel('Country_name')
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
                StringField::create('native')
                    ->setLabel('Native')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('timezone')
                    ->setLabel('Timezone')
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
        ;
    }
}
