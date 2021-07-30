<?php

namespace App\Controller;

use App\Entity\NewsCategory;
use App\Entity\Project;
use App\Entity\ProjectCategory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml/{locale}", name="sitemap", defaults={"_format"="xml"})
     */
    public function index(Request $request): Response
    {
        // Nous récupérons le nom d'hôte depuis l'URL
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        // On ajoute les URLs "statiques"
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('news')];
        $urls[] = ['loc' => $this->generateUrl('press')];
        $urls[] = ['loc' => $this->generateUrl('about_me')];
        $urls[] = ['loc' => $this->generateUrl('contact')];

        // On ajoute les URLs dynamiques des projects dans le tableau
        foreach ($this->getDoctrine()->getRepository(Project::class)->findAll() as $project) {
            $urls[] = [
                'loc' => $this->generateUrl('show_one_project', [
                    'slug' => $project->getSlug(),
                ]),
            ];
        }
        foreach ($this->getDoctrine()->getRepository(ProjectCategory::class)->findAll() as $category) {
            $urls[] = [
                'loc' => $this->generateUrl('projects_by_cat', [
                    'categoryId' => $category->getId(),
                ]),
            ];
        }
        foreach ($this->getDoctrine()->getRepository(NewsCategory::class)->findAll() as $category) {
            $urls[] = [
                'loc' => $this->generateUrl('news_by_cat', [
                    'newsCategoryId' => $category->getId(),
                ]),
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
            'urls' => $urls,
            'hostname' => $hostname,
            ]),
            200
        );

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
