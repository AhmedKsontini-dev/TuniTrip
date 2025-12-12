<?php

namespace App\Form;

use App\Entity\Excursion;
use App\Entity\ReservationExcursion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReservationExcursionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'exemple@email.com']
            ])
            ->add('tel')
            ->add('adult')
            ->add('child')
            ->add('dateHeure')
            ->add('localisationPoint')
            ->add('excursion', EntityType::class, [
                'class' => Excursion::class,
                'choice_label' => 'titre',
                'attr' => ['hidden' => true],
                'label' => false
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
