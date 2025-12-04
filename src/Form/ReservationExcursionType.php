<?php

namespace App\Form;

use App\Entity\Excursion;
use App\Entity\ReservationExcursion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationExcursionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adult')
            ->add('child')
            ->add('dateHeure')
            ->add('localisationPoint')
            ->add('dateCreation')
            ->add('statut')
            ->add('excursion', EntityType::class, [
                'class' => Excursion::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationExcursion::class,
        ]);
    }
}
