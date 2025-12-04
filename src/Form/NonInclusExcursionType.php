<?php

namespace App\Form;

use App\Entity\NonInclusExcursion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NonInclusExcursionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('item', TextType::class, [
            'label' => 'Non inclus',
            'attr' => ['class' => 'form-control mb-2'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => NonInclusExcursion::class]);
    }
}
