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
            ->add('pickupDate', DateType::class, ['widget' => 'single_text', 'label' => 'form.transfer.pickup_date'])
            ->add('pickupTime', null, ['widget' => 'single_text', 'label' => 'form.transfer.pickup_time'])
            ->add('pickupLocation', TextType::class, [
                    'attr' => ['readonly' => true],
                    'label' => 'form.transfer.pickup_location',
                ])
            ->add('dropoffLocation', TextType::class, [
                    'attr' => ['readonly' => true],
                    'label' => 'form.transfer.dropoff_location',
                ])

            ->add('transferType', ChoiceType::class, [
                'choices' => [
                    'form.transfer.type_one_way' => 'one_way',
                    'form.transfer.type_return' => 'return',
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'form.transfer.type',
            ])
            ->add('persons', NumberType::class, ['label' => 'form.transfer.persons'])
            ->add('returnPickupDate', DateType::class, ['widget' => 'single_text', 'required' => false, 'label' => 'form.transfer.return_date'])
            ->add('returnPickupTime', null, ['widget' => 'single_text', 'required' => false, 'label' => 'form.transfer.return_time'])
            ->add('returnPickupLocation', HiddenType::class, ['required' => false])
            ->add('returnDropoffLocation', HiddenType::class, ['required' => false])
            ->add('firstName', TextType::class, ['label' => 'form.transfer.firstname'])
            ->add('lastName', TextType::class, ['label' => 'form.transfer.lastname'])
            ->add('email', EmailType::class, ['label' => 'form.transfer.email'])
            ->add('tel', TelType::class, ['label' => 'form.transfer.phone'])
            ->add('whatsappNumber', TextType::class, ['required' => false, 'label' => 'form.transfer.whatsapp'])
            ->add('flightNumber', TextType::class, ['required' => false, 'label' => 'form.transfer.flight'])
            ->add('comments', TextareaType::class, ['required' => false, 'label' => 'form.transfer.comments'])
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