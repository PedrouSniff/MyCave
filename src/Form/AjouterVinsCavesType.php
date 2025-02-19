<?php

namespace App\Form;

use App\Entity\Caves;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjouterVinsCavesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cave', EntityType::class, [
                'class' => Caves::class,
                'choices' => $options['caves'],
                'choice_label' => 'nom',
                'label' => 'Choisissez votre cave',
                'placeholder' => 'Sélectionnez une cave',
                'multiple' => false,
                'expanded' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'caves' => [], // Valeur par défaut vide pour éviter les erreurs
        ]);

        $resolver->setAllowedTypes('caves', 'array'); // Vérification du type attendu
    }
}