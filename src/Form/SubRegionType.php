<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Region;
use App\Entity\SubRegion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubRegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('wikiDataId')
            ->add('region_id', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'label' => 'app.ui.region',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubRegion::class,
        ]);
    }
}
