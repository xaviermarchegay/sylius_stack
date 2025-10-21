<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('latitude')
            ->add('longitude')
            ->add('native')
            ->add('timezone', TimezoneType::class, [
                'preferred_choices' => ['Europe/Paris', 'UTC'],
            ])
            ->add('wikiDataId')
            ->add('country_id', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
                'label' => 'app.ui.country',
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
