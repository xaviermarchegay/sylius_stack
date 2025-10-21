<?php

namespace App\Grid;

use App\Entity\Country;
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
                StringField::create('iso2')
                    ->setLabel('Iso2')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('numeric_code')
                    ->setLabel('Numeric_code')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('phonecode')
                    ->setLabel('Phonecode')
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
                StringField::create('currency_name')
                    ->setLabel('Currency_name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('currency_symbol')
                    ->setLabel('Currency_symbol')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('tld')
                    ->setLabel('Tld')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('native')
                    ->setLabel('Native')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('population')
                    ->setLabel('Population')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('gdp')
                    ->setLabel('Gdp')
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
                StringField::create('nationality')
                    ->setLabel('Nationality')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('timezones')
                    ->setLabel('Timezones')
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
                StringField::create('emoji')
                    ->setLabel('Emoji')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('emojiU')
                    ->setLabel('EmojiU')
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
