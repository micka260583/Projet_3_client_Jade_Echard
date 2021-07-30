<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Galery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('subtitleFr')
            ->add('subtitleEn')
            ->add('projectDate')
            ->add('projectCategory')
            ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('mainIllustration')
            ->add('secondIllustration')
            ->add('otherPicto')
            ->add('exhibitionLogo')
            ->add('moreInfoLink')
            ->add('otherLogo')
            ->add('linkOtherLogo')
            ->add('galery')
            ->add('galery', CollectionType::class, [
                'entry_type' => GaleryType::class,
                'entry_options' => ['label' => false],
                'allow_add' => false,
                /* 'by_reference' => false, */
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
