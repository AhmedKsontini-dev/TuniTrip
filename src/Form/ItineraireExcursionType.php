<?php

namespace App\Form;

use App\Entity\ItineraireExcursion;
use App\Form\ItinerairePhotoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ItineraireExcursionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreEtape', TextType::class, [
                'label' => 'Titre de l\'étape',
                'attr' => [
                    'class' => 'form-control form-control-lg shadow-sm rounded-3',
                    'placeholder' => 'Ex: Arrivée au site',
                ],
            ])
            ->add('descriptionEtape', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'class' => 'form-control form-control-lg shadow-sm rounded-3',
                    'rows' => 4,
                    'placeholder' => 'Détails de l\'étape...',
                ],
            ])
            ->add('ordre', IntegerType::class, [
                'label' => 'Ordre',
                'required' => false,
                'attr' => [
                    'class' => 'form-control form-control-lg shadow-sm rounded-3',
                    'placeholder' => 'Numéro de l\'étape',
                    'min' => 1,
                ],
            ])
            ->add('coordinates', TextType::class, [
                'label' => 'Coordonnées (latitude,longitude)',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])

            ->add('dureeVisite', TextType::class, [
                'label' => 'Durée de visite',
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: 1h30'],
            ])
            ->add('admission', TextType::class, [
                'label' => 'Admission',
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Gratuit / Payant'],
            ])
            ->add('photos', CollectionType::class, [
                'entry_type' => ItinerairePhotoType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'label' => false,  // <-- important
                'attr' => ['class' => 'photos-collection'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ItineraireExcursion::class,
        ]);
    }
}
