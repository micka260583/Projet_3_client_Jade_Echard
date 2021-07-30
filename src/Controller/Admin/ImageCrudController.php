<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Field\IllustrationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Images');
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IllustrationField::new('imageLink')->onlyOnForms(),
            IdField::new('id')->onlyOnIndex(),
        ];

        if ($pageName == Crud::PAGE_INDEX) {
            $image = ImageField::new('imageLink', 'Image')->setBasePath('images/');
            array_push($fields, $image);
        }

        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter une image');
            })
        ;
    }
}
