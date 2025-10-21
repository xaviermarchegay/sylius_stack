<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Country;
use App\Entity\Region;
use App\Entity\SubRegion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('iso3')
            ->add('iso2')
            ->add('numeric_code')
            ->add('phonecode')
            ->add('capital')
            ->add('currency', CurrencyType::class)
            ->add('tld')
            ->add('native')
            ->add('population')
            ->add('gdp')
            ->add('region')
            ->add('subregion')
            ->add('nationality')
            ->add('latitude')
            ->add('longitude')
            ->add('emoji')
            ->add('wikiDataId')
            ->add('region_id', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'label' => 'app.ui.region',
            ])
            ->add('subregion_id', EntityType::class, [
                'class' => SubRegion::class,
                'choice_label' => 'name',
                'label' => 'app.ui.sub_region',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
