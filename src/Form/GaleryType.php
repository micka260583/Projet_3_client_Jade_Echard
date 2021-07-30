<?php

namespace App\Form;

use App\Entity\Galery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GaleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre FR',])
            ->add('titleEn', TextType::class, ['label' => 'Titre EN',])
            ->add('subtitleFr', TextType::class, ['label' => 'Sous-titre FR',])
            ->add('subtitleEn', TextType::class, ['label' => 'Sous-titre EN',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Galery::class,
        ]);
    }
}
