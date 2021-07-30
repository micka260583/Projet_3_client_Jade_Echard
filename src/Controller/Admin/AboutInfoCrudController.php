<?php

namespace App\Controller\Admin;

use App\Entity\AboutInfo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AboutInfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AboutInfo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Parcours, expositions, prix');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title_Fr', 'Titre FR'),
            TextField::new('title_En', 'Titre EN'),
            TextField::new('timing', 'Date'),
            AssociationField::new('info_category', 'Catégorie'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter');
            })
        ;
    }
}
