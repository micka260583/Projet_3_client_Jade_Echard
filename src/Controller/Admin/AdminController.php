<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Entity\AboutInfo;
use App\Entity\Contact;
use App\Entity\News;
use App\Entity\Press;
use App\Entity\Project;
use App\Entity\GaleryCollection;
use App\Entity\Tech;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_USER")
 */
class AdminController extends AbstractDashboardController
{
    /**
     * @Route("/ijustcantgetenough", name="ijustcantgetenough")
     */
    public function index(): Response
    {

        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(ProjectCrudController::class)->generateUrl());
        /* return parent::index(); */
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            /* ->setTitle('Jade Echard') */
            ->setTitle('<img src="https://zupimages.net/up/21/23/4gvl.png">');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Retour sur le site', 'fa fa-home', 'home');
        yield MenuItem::linkToRoute('Déconnexion', 'fa fa-sign-out', 'logout');
        yield MenuItem::section('Menu');
        yield MenuItem::subMenu('Projets', '')->setSubItems([
            MenuItem::linkToCrud('Tous les projets', '', Project::class),
            MenuItem::linkToCrud('Collections', '', GaleryCollection::class),
        ]);
        yield MenuItem::subMenu('À propos', '')->setSubItems([
            MenuItem::linkToCrud('Description', '', About::class),
            MenuItem::linkToCrud('Parcours, expo, prix', '', AboutInfo::class),
        ]);
        yield MenuItem::linkToCrud('News', '', News::class);
        yield MenuItem::linkToCrud('Presse', '', Press::class);
        yield MenuItem::linkToCrud('Messages reçus', '', Contact::class)
            ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Utilisateurs', '', User::class)
            ->setPermission('ROLE_ADMIN');
    }
}
