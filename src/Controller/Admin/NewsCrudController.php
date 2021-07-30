<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Field\IllustrationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields =  [
            TextField::new('Title_Fr', 'Titre FR'),
            TextField::new('Play_On', 'Date'),
        ];

        if ($pageName == Crud::PAGE_DETAIL) {
            $fields[] = TextField::new('Title_En', 'Titre EN');
            $fields[] = AssociationField::new('news_category');
            $fields[] = TextField::new('Link', 'Lien');
            $fields[] = TextareaField::new('DescriptionFr', 'Description FR');
            $fields[] = TextareaField::new('DescriptionEn', 'Description EN');
        }

        if ($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_NEW) {
            $fields[] = TextField::new('Title_En', 'Titre EN');
            $fields[] = AssociationField::new('news_category');
            $fields[] = TextField::new('Link', 'Lien');
            $fields[] = TextareaField::new('DescriptionFr', 'Description FR');
            $fields[] = TextareaField::new('DescriptionEn', 'Description EN');
            $fields[] = IllustrationField::new('illustration');
        }

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $image = ImageField::new('illustration')->setBasePath('images/');
            array_push($fields, $image);
        }

        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter une news');
            })
        ;
    }
}
