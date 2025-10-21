<?php

declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\AdminUi\Knp\Menu\MenuBuilderInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: 'sylius_admin_ui.knp.menu_builder')]
final readonly class MenuBuilder implements MenuBuilderInterface
{
    public function __construct(
        private readonly FactoryInterface $factory,
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu
            ->addChild('dashboard', [
                'route' => 'sylius_admin_ui_dashboard',
            ])
            ->setLabel('sylius.ui.dashboard')
            ->setLabelAttribute('icon', 'tabler:dashboard')
        ;

        $world = $menu
            ->addChild('world')
            ->setLabel('app.ui.world')
            ->setLabelAttribute('icon', 'tabler:globe')
        ;

        $world
            ->addChild('region', [
                'route' => 'app_admin_region_index',
            ])
            ->setLabel('app.ui.regions')
        ;

        $world
            ->addChild('sub_region', [
                'route' => 'app_admin_sub_region_index',
            ])
            ->setLabel('app.ui.sub_regions')
        ;

        $world
            ->addChild('country', [
                'route' => 'app_admin_country_index',
            ])
            ->setLabel('app.ui.countries')
        ;

        $world
            ->addChild('city', [
                'route' => 'app_admin_city_index',
            ])
            ->setLabel('app.ui.cities')
        ;

        return $menu;
    }
}