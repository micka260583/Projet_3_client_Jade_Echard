<?php

namespace App\Controller\Admin;

use App\Entity\Press;
use App\Field\IllustrationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Press::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Articles de presse');
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter un article');
            })
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        $fields =  [
            DateField::new('Created_At', 'Date de création'),
            TextField::new('Title', 'Titre'),
        ];

        if ($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_NEW) {
            $fields[] = TextField::new('Link_Press', 'Lien');
            $fields[] = IllustrationField::new('logo_media');
            $fields[] = IllustrationField::new('illustration');
        }

        if ($pageName == Crud::PAGE_INDEX) {
            $image = ImageField::new('illustration')->setBasePath('images/');
            array_push($fields, $image);
        }

        if ($pageName == Crud::PAGE_DETAIL) {
            $image = ImageField::new('illustration')->setBasePath('images/');
            $logo = ImageField::new('logo_media')->setBasePath('images/');
            array_push($fields, $image, $logo);
        }

        return $fields;
    }
}
