<?php

namespace App\Form;

use App\Entity\Imprimantes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImprimanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => "Entrez le nom de l'imprimante",
                'attr' => [
                'placeholder' => "",
            ],
            ])
            ->add('numero', IntegerType::class, [
                'label' => "Entrez le numéro de l'imprimante",
                'attr' => [
                'placeholder' => "",
            ],
            ])
            ->add('Ip', TextType::class, [
                'label' => "Entrez l'adresse Ip de l'imprimante",
                'attr' => [
                'placeholder' => "",
            ],
            ])
            ->add('mibColorA4', TextType::class, [
                'label' => "Entrez le code MIB Couleur A4 de l'imprimante",
                'attr' => [
                'placeholder' => "",
            ],
            ])
            ->add('mibColorA3', TextType::class, [
                'label' => "Entrez le code MIB Couleur A3 de l'imprimante",
                'attr' => [
                'placeholder' => "",
            ],
            ])
            ->add('mibBlackWitheA4', TextType::class, [
                'label' => "Entrez le code MIB N/B A4 de l'imprimante",
                'attr' => [
                'placeholder' => "",
            ],
            ])
            ->add('mibBlackWitheA3', TextType::class, [
                'label' => "Entrez le code MIB N/B A3 de l'imprimante",
                'attr' => [
                'placeholder' => "",
            ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Imprimantes::class,
        ]);
    }
}
