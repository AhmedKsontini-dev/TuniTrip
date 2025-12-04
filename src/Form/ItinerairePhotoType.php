<?php

namespace App\Form;

use App\Entity\ItinerairePhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ItinerairePhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'mapped' => false, // important si tu n’as pas de champ 'imageFile' dans l'entité
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('legende', TextType::class, [
                'label' => 'Légende',
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Description de l\'image'],
            ])
            ->add('ordre', IntegerType::class, [
                'label' => 'Ordre',
                'required' => false,
                'attr' => ['class' => 'form-control', 'min' => 1],
            ]);
            }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ItinerairePhoto::class,
        ]);
    }
}
