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
            ->add('pickupDate', DateType::class, ['widget' => 'single_text'])
            ->add('pickupTime', null, ['widget' => 'single_text'])
            ->add('pickupLocation', TextType::class, [
                    'attr' => ['readonly' => true],
                ])
            ->add('dropoffLocation', TextType::class, [
                    'attr' => ['readonly' => true],
                ])

            ->add('transferType', ChoiceType::class, [
                'choices' => [
                    'One Way' => 'one_way',
                    'Return (new ride)' => 'return',
                ],
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('persons', NumberType::class)
            ->add('returnPickupDate', DateType::class, ['widget' => 'single_text', 'required' => false])
            ->add('returnPickupTime', null, ['widget' => 'single_text', 'required' => false])
            ->add('returnPickupLocation', HiddenType::class, ['required' => false])
            ->add('returnDropoffLocation', HiddenType::class, ['required' => false])
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class)
            ->add('tel', TelType::class)
            ->add('whatsappNumber', TextType::class, ['required' => false])
            ->add('flightNumber', TextType::class, ['required' => false])
            ->add('comments', TextareaType::class, ['required' => false])
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