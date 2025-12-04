<?php

namespace App\Form;

use App\Entity\Voitures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class VoituresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('immatriculation')
            ->add('prixJour')
            ->add('image', FileType::class, [
                'mapped' => false,    // ✅ Le champ ne correspond pas directement à la propriété "image"
                'required' => false,  // ✅ Le fichier n’est pas obligatoire
            ])
            ->add('disponible')
            ->add('description')
            ->add('boiteVitesse')
            ->add('climatiseur')
            ->add('passengers')
            ->add('suitcases')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voitures::class,
        ]);
    }
}
