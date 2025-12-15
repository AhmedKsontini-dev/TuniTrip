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
                'label' => 'form.voiture.nom',
                'attr' => ['required' => true]
            ])
            ->add('prenom', TextType::class, ['label' => 'form.voiture.prenom'])
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, [
                'label' => 'form.voiture.email',
                'attr' => ['placeholder' => 'form.voiture.placeholder_email']
            ])
            ->add('dateNaissance', DateType::class, [
                'label' => 'form.voiture.date_naissance',
                'widget' => 'single_text',
                'attr' => [
                    'required' => true,
                    'max' => (new \DateTime('-18 years'))->format('Y-m-d')
                ]
            ])
            ->add('lieuNaissance', TextType::class, ['label' => 'form.voiture.lieu_naissance'])
            ->add('nationalite', TextType::class, ['label' => 'form.voiture.nationalite'])
            ->add('adresse', TextType::class, ['label' => 'form.voiture.adresse'])
            ->add('tel', TelType::class, ['label' => 'form.voiture.tel'])
            ->add('numCinPassport', TextType::class, ['label' => 'form.voiture.cin'])
            ->add('cinDelivreLe', DateType::class, [ 'label' => 'form.voiture.cin_date', 'widget' => 'single_text', 'required' => true ])
            ->add('numPermis', TextType::class, ['label' => 'form.voiture.permis_num', 'required' => true])
            ->add('permisDelivreLe', DateType::class, [
                'label' => 'form.voiture.permis_date',
                'widget' => 'single_text',
                'attr' => [
                    'max' => (new \DateTime('-2 years'))->format('Y-m-d')
                ]
            ])
            ->add('permisLieuDelivrance', TextType::class, ['label' => 'form.voiture.permis_lieu', 'required' => true])
            ->add('dateDebut', DateType::class, [
                'label' => 'form.voiture.date_debut',
                'widget' => 'single_text',
                'attr' => ['min' => (new \DateTime())->format('Y-m-d')]
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'form.voiture.date_fin',
                'widget' => 'single_text',
                'attr' => ['min' => (new \DateTime())->format('Y-m-d')]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => ReservationVoiture::class]);
    }
}
