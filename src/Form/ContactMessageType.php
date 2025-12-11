<?php

namespace App\Form;

use App\Entity\ContactMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'required' => true,
                'attr' => ['placeholder' => 'Entrez votre nom']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'required' => true,
                'attr' => ['placeholder' => 'Entrez votre email']
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Sujet',
                'required' => true,
                'attr' => ['placeholder' => 'Objet de votre message']
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'required' => true,
                'attr' => ['placeholder' => 'Votre message', 'rows' => 4]
            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactMessage::class,
        ]);
    }
}
