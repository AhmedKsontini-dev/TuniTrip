<?php

namespace App\Form;

use App\Entity\InclusExcursion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InclusExcursionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('item', TextType::class, [
            'label' => 'Inclus',
            'attr' => ['class' => 'form-control mb-2'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => InclusExcursion::class]);
    }
}

