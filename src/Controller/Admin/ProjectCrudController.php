<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Field\GaleryField;
use App\Field\IllustrationField;
use App\Field\GaleryCollectionField;
use App\Form\GaleryCollectionType;
use App\Form\GaleryType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Projets')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouveau projet')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du projet')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier le projet');
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        if ($pageName == Crud::PAGE_INDEX) {
            array_push(
                $fields,
                TextField::new('title', 'Titre'),
                TextField::new('subtitleFr', 'Sous-titre FR'),
                TextField::new('projectDate', 'Date du projet'),
                ImageField::new('mainIllustration', 'Illustration principale')->setBasePath('images/'),
            );
        }
        if ($pageName == Crud::PAGE_NEW || $pageName == Crud::PAGE_EDIT) {
            array_push(
                $fields,
                TextField::new('title', 'Titre'),
                AssociationField::new('projectCategory', 'Catégorie'),
                TextField::new('subtitleFr', 'Sous-titre FR'),
                TextField::new('subtitleEn', 'Sous-titre EN'),
                TextField::new('projectDate', 'Date du projet'),
                TextEditorField::new('descriptionFr', 'Description FR'),
                TextEditorField::new('descriptionEn', 'Description EN'),
                IllustrationField::new('mainIllustration', 'Illlustration principale'),
                IllustrationField::new('secondIllustration', 'Illustration secondaire'),
                IllustrationField::new('otherPicto', 'Pictogramme'),
                IllustrationField::new('exhibitionLogo', 'Logo 1'),
                TextField::new('moreInfoLink', 'Lien logo 1'),
                IllustrationField::new('otherLogo', 'Logo 2'),
                TextField::new('linkOtherLogo', 'Lien logo 2'),
                GaleryField::new('galery', 'Galerie'),
                CollectionField::new('collections')->setFormTypeOptions([
                    'delete_empty' => true,
                    'by_reference' => false,
                ])->setEntryIsComplex(false)->setCustomOptions([
                    'allowAdd' => true,
                    'allowDelete' => true,
                    'entryType' => 'App\Form\GaleryCollectionType',
                    'showEntryLabel' => false,
                ]),
            );
        }

        if ($pageName == Crud::PAGE_DETAIL) {
            array_push(
                $fields,
                TextField::new('title', 'Titre'),
                AssociationField::new('projectCategory', 'Catégorie'),
                TextField::new('subtitleFr', 'Sous-titre FR'),
                TextField::new('subtitleEn', 'Sous-titre EN'),
                TextField::new('projectDate', 'Date du projet'),
                TextEditorField::new('descriptionFr', 'Description FR'),
                TextEditorField::new('descriptionEn', 'Description EN'),
                ImageField::new('mainIllustration', 'Illustration principale')->setBasePath('images/'),
                ImageField::new('secondIllustration', 'Illustration secondaire')->setBasePath('images/'),
                ImageField::new('otherPicto', 'Pictogramme')->setBasePath('images/'),
                ImageField::new('exhibitionLogo', 'Logo 1')->setBasePath('images/'),
                TextField::new('moreInfoLink', 'Lien logo 1'),
                ImageField::new('otherLogo', 'Logo 2')->setBasePath('images/'),
                TextField::new('linkOtherLogo', 'Lien logo 2'),
                GaleryField::new('galery', 'Galerie')->setTemplatePath('admin/details_galery.html.twig'),
                GaleryCollectionField::new('collections')
            );
        }

        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter un projet');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Créer un projet');
            })
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setLabel('Créer et ajouter un nouveau');
            })
        ;
    }
}
