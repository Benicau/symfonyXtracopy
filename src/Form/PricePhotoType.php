<?php

namespace App\Form;

use App\Entity\PricePhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PricePhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Name', TextType::class, [
            'label' => "Nom",
            'attr' => [
            'placeholder' => "",
        ],
        ])

        ->add('Price', NumberType::class, [
            'label' => "Prix",
            'attr' => [
            'placeholder' => "",
        ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PricePhoto::class,
        ]);
    }
}
