<?php

namespace App\Form;

use App\Entity\ReservationTransfert;
use App\Enum\TransferType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\CallbackTransformer;

class ReservationTransfertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pickupDate', DateType::class, ['widget' => 'single_text', 'label' => 'Date de prise en charge'])
            ->add('pickupTime', null, ['widget' => 'single_text', 'label' => 'Heure de prise en charge'])
            ->add('pickupLocation', TextType::class, [
                    'attr' => ['readonly' => true],
                    'label' => 'Lieu de départ',
                ])
            ->add('dropoffLocation', TextType::class, [
                    'attr' => ['readonly' => true],
                    'label' => 'Lieu d\'arrivée',
                ])

            ->add('transferType', ChoiceType::class, [
                'choices' => [
                    'Aller simple' => 'one_way',
                    'Aller-retour' => 'return',
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Type de transfert',
            ])
            ->add('persons', NumberType::class, ['label' => 'Nombre de personnes'])
            ->add('returnPickupDate', DateType::class, ['widget' => 'single_text', 'required' => false, 'label' => 'Date de retour'])
            ->add('returnPickupTime', null, ['widget' => 'single_text', 'required' => false, 'label' => 'Heure de retour'])
            ->add('returnPickupLocation', HiddenType::class, ['required' => false])
            ->add('returnDropoffLocation', HiddenType::class, ['required' => false])
            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('lastName', TextType::class, ['label' => 'Nom'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('tel', TelType::class, ['label' => 'Téléphone'])
            ->add('whatsappNumber', TextType::class, ['required' => false, 'label' => 'Numéro WhatsApp'])
            ->add('flightNumber', TextType::class, ['required' => false, 'label' => 'Numéro de vol'])
            ->add('comments', TextareaType::class, ['required' => false, 'label' => 'Commentaires'])
        ;

        // Transformer pour convertir string <-> enum
        $builder->get('transferType')
            ->addModelTransformer(new CallbackTransformer(
                function (?TransferType $transferType): ?string {
                    // Transform enum to string for the form
                    return $transferType?->value;
                },
                function (?string $value): ?TransferType {
                    // Transform string back to enum
                    return $value ? TransferType::from($value) : null;
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationTransfert::class,
        ]);
    }
}