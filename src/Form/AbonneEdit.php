<?php

namespace App\Form;

use App\Entity\Abonne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AbonneEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class, [
                'disabled' => true,
            ])
            ->add('Nom', TextType::class, [
                'label' => "Nom"
            ])
            ->add('Surname', TextType::class, [
                'label' => "Prénom"
            ])
            ->add('mail', EmailType::class, [
                'label' => "Email (pas obligatoire)",
                'required' => false, // Permet une valeur nulle
            ])
            ->add('Color', IntegerType::class, [
                'label' => "Nombre de copie couleur"
            ])
            ->add('BlackWhite', IntegerType::class, [
                'label' => "Nombre de copie noir et blanc"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonne::class,
        ]);
    }
}
