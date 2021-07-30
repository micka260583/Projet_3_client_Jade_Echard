<?php

namespace App\Field;

use App\Form\GaleryCollectionType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

final class GaleryCollectionField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('admin/details_collection.html.twig')
            ->setFormType(GaleryCollectionType::class)
        ;
    }
}
