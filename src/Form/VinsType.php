<?php

namespace App\Form;

use App\Entity\Raisins;
use App\Entity\RaisinsVins;
use App\Entity\Vins;
use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class VinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'nom',
            ])
            ->add('imageFile', FileType::class, [
                'required'   => false,
                'mapped'     => true,
                'constraints' => [
                    new File([
                        'maxSize'   => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG, PNG, GIF).',
                    ])
                ],
            ]);
            // ->add('raisinsVins', EntityType::class, [
            //     'class' => Raisins::class,
            //     'choice_label' => 'nom',
            //     'label' => 'Type de raisins',
            //     'multiple' => true,
            //     'expanded' => true,
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vins::class,
        ]);
    }
}
