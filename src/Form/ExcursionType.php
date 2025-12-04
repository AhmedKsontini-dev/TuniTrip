<?php

namespace App\Form;

use App\Entity\Excursion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ExcursionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('categorie', TextType::class, ['required' => false])
            ->add('duree', TextType::class, ['required' => false])
            ->add('prixParPersonne', MoneyType::class, ['currency' => 'TND'])
            ->add('localisation', TextType::class, ['required' => false])
            ->add('cancellation', TextType::class, ['required' => false])
            ->add('description', CKEditorType::class, [
                'config_name' => 'default',
                'required' => false,
            ])
            ->add('aPropos', CKEditorType::class, [
                'config_name' => 'default',
                'required' => false,
                'label' => 'À quoi s\'attendre',

            ])
            ->add('ages', TextType::class, ['required' => false, 'label' => 'Tranche d’âges'])
            ->add('max_pers', TextType::class, ['required' => false, 'label' => 'Nombre max de participants'])
            ->add('guide', TextType::class, ['required' => false, 'label' => 'Guide'])
            ->add('imagePrincipale', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('actif', CheckboxType::class, ['required' => false]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Excursion::class,
        ]);
    }
}
