<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('state_id')
            ->add('state_code')
            ->add('state_name')
            ->add('country_code')
            ->add('country_name')
            ->add('latitude')
            ->add('longitude')
            ->add('native')
            ->add('timezone')
            ->add('wikiDataId')
            ->add('country_id', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
