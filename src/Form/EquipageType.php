<?php

namespace App\Form;

use App\Entity\Equipage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fistName', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Votre e-mail',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('adress', TextType::class, [
                'label' => 'Votre adresse',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-outline-success me-2'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipage::class,
        ]);
    }
}