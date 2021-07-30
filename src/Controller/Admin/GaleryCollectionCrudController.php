<?php

namespace App\Controller\Admin;

use App\Entity\GaleryCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class GaleryCollectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GaleryCollection::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Collections');
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title', 'Titre'),
            TextareaField::new('descriptionFr', 'Description Fr'),
            TextareaField::new('descriptionEn', 'Description En'),
            AssociationField::new('project', 'Projet'),
        ];

        if ($pageName == Crud::PAGE_NEW || $pageName == Crud::PAGE_EDIT) {
            array_push(
                $fields,
                CollectionField::new('images')->setFormTypeOptions([
                    'delete_empty' => false,
                    'by_reference' => false,
                ])->setEntryIsComplex(false)->setCustomOptions([
                    'allowAdd' => true,
                    'allowDelete' => true,
                    'entryType' => 'App\Form\ImageType',
                    'showEntryLabel' => false,
                ]),
            );
        }

        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setLabel('Ajouter une collection');
        })
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
            return $action->setLabel('Créer une collection');
        })
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
            return $action->setLabel('Créer et ajouter une nouvelle collection');
        })
        ;
    }
}
