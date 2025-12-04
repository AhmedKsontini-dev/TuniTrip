<?php

namespace App\Form;

use App\Entity\ReservationVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['required' => true]
            ])
            ->add('prenom', TextType::class, ['label' => 'Prénom'])
            ->add('dateNaissance', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'attr' => [
                    'required' => true,
                    'max' => (new \DateTime('-18 years'))->format('Y-m-d')
                ]
            ])
            ->add('lieuNaissance', TextType::class, ['label' => 'Lieu de naissance'])
            ->add('nationalite', TextType::class, ['label' => 'Nationalité'])
            ->add('adresse', TextType::class, ['label' => 'Adresse'])
            ->add('tel', TelType::class, ['label' => 'Téléphone'])
            ->add('numCinPassport', TextType::class, ['label' => 'CIN / Passeport'])
            ->add('cinDelivreLe', DateType::class, [ 'label' => 'CIN délivré le', 'widget' => 'single_text', 'required' => true ])
            ->add('numPermis', TextType::class, ['label' => 'Numéro de permis', 'required' => true])
            ->add('permisDelivreLe', DateType::class, [
                'label' => 'Permis délivré le',
                'widget' => 'single_text',
                'attr' => [
                    'max' => (new \DateTime('-2 years'))->format('Y-m-d')
                ]
            ])
            ->add('permisLieuDelivrance', TextType::class, ['label' => 'Lieu de délivrance du permis', 'required' => true])
            ->add('dateDebut', DateType::class, [
                'label' => 'Date de début de location',
                'widget' => 'single_text',
                'attr' => ['min' => (new \DateTime())->format('Y-m-d')]
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Date de fin de location',
                'widget' => 'single_text',
                'attr' => ['min' => (new \DateTime())->format('Y-m-d')]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => ReservationVoiture::class]);
    }
}
