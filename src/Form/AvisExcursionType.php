<?php
namespace App\Form;

use App\Entity\AvisExcursion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisExcursionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note', ChoiceType::class, [
                'choices' => [
                    '1 - Horrible' => 1,
                    '2 - Médiocre' => 2,
                    '3 - Moyen' => 3,
                    '4 - Très bon' => 4,
                    '5 - Excellent' => 5,
                ],
                'expanded' => true, // pour afficher comme boutons radio
            ])
            ->add('compagnon', ChoiceType::class, [
                'choices' => [
                    'Affaires' => 'Affaires',
                    'Couples' => 'Couples',
                    'En famille' => 'Famille',
                    'Amis' => 'Amis',
                    'Solo' => 'Solo',
                ],
                'placeholder' => 'Choisir...',
            ])
            ->add('titre', TextType::class, [
                'required' => false,
            ])
            ->add('commentaire', TextareaType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AvisExcursion::class,
        ]);
    }
}
