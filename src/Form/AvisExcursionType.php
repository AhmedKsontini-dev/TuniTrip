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
                    5 => 5,
                    4 => 4,
                    3 => 3,
                    2 => 2,
                    1 => 1,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => false,
                'choice_label' => false,
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
