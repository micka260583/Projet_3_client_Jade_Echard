<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Entity\NewsCategory;
use App\Entity\Project;
use App\Entity\ProjectCategory;
use App\Form\ContactType;
use App\Repository\AboutInfoCategoryRepository;
use App\Repository\AboutRepository;
use App\Repository\NewsCategoryRepository;
use App\Repository\NewsRepository;
use App\Repository\PressRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectCategoryRepository;
use Doctrine\Persistence\ObjectRepository;
use Locale;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FrontController extends AbstractController
{
    private ObjectRepository $projectRepo;
    private ObjectRepository $projectCatRepo;
    private ObjectRepository $newsCatRepo;
    private ObjectRepository $newsRepo;
    private ObjectRepository $pressRepo;
    private ObjectRepository $aboutRepo;
    private ObjectRepository $aboutInfoCatRepo;

    public function __construct(
        ProjectRepository $projectRepo,
        ProjectCategoryRepository $projectCatRepo,
        NewsRepository $newsRepo,
        NewsCategoryRepository $newsCatRepo,
        PressRepository $pressRepo,
        AboutRepository $aboutRepo,
        AboutInfoCategoryRepository $aboutInfoCatRepo
    ) {
        $this->projectRepo = $projectRepo;
        $this->projectCatRepo = $projectCatRepo;
        $this->newsRepo = $newsRepo;
        $this->newsCatRepo = $newsCatRepo;
        $this->pressRepo = $pressRepo;
        $this->aboutRepo = $aboutRepo;
        $this->aboutInfoCatRepo = $aboutInfoCatRepo;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('front/home.html.twig', [
            'projects' => $this->projectRepo->findAll(),
            'categories' => $this->projectCatRepo->findAll(),
        ]);
    }

    /**
     * @Route({"en": "/projects/{categorySlug}", "fr": "/projets/{categorySlug}"}, methods={"GET"}, name="projects_by_cat")
     * @ParamConverter("projectCategory", class="App\Entity\ProjectCategory", options={"mapping": {"categorySlug": "slug"}})
     */
    public function projectByCat(ProjectCategory $projectCategory): Response
    {
        return $this->render('front/home.html.twig', [
            'projects' => $projectCategory->getProjects(),
            'categories' => $this->projectCatRepo->findAll(),
        ]);
    }

    /**
     * @Route("/news/{newsCategorySlug}", methods={"GET"}, name="news_by_cat")
     * @ParamConverter("newsCategory", class="App\Entity\NewsCategory", options={"mapping": {"newsCategorySlug": "slug"}})
     */
    public function newsByCat(NewsCategory $newsCategory): Response
    {
        return $this->render('front/news.html.twig', [
            'news' => $newsCategory->getNews(),
            'newsCategories' => $this->newsCatRepo->findAll(),
        ]);
    }

    /**
     * @Route({"en": "/project/{slug}", "fr": "/projet/{slug}"}, name="show_one_project")
     */
    public function showOneProject(Project $project): Response
    {
        return $this->render('front/show_one_project.html.twig', [
            'project' => $project,
            'categories' => $this->projectCatRepo->findAll(),
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $email = (new Email())
            ->from('jenny.test4php@gmail.com')
            ->to('jenny.test4php@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html($this->renderView('front/newEmail.html.twig', ['contact' => $contact]));

            $mailer->send($email);


            $this->addFlash('success', 'Votre message a bien été envoyé ! - Your message has been sent !');

            return $this->redirectToRoute('contact');
        }

        return $this->render('front/contact.html.twig', [
            'contact' => $contact,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/news", name="news")
     */
    public function news(): Response
    {
        return $this->render('front/news.html.twig', [
            'news' => $this->newsRepo->findAll(),
            'newsCategories' => $this->newsCatRepo->findAll(),
        ]);
    }

    /**
     * @Route({"en": "/press", "fr": "/presse"}, name="press")
     */
    public function press(): Response
    {
        return $this->render('front/press.html.twig', [
            'press' => $this->pressRepo->findAll(),
        ]);
    }

    /**
     * @Route({"en": "/about-me", "fr": "/a-propos"}, name="about_me")
     */
    public function aboutMe(): Response
    {
        return $this->render('front/about.html.twig', [
            'about' => $this->aboutRepo->findAll()[0],
            'aboutCategories' =>  $this->aboutInfoCatRepo->findAll()
        ]);
    }

    /**
     * @Route("/change-locale/{locale}", name="change_locale")
     */
    public function changeLocale(string $locale, RouterInterface $router, Request $request): Response
    {
        // on récupère la locale demandé et on l'enregistre dans la session
        $request->getSession()->set('_locale', $locale);

        $routeInfos = $router->match(Request::create($request->headers->get('referer'))->getPathInfo());
        $routeName = $routeInfos['_route'];
        unset($routeInfos['_route'], $routeInfos['_controller'], $routeInfos['_locale']);

        // puis on redirige vers la page sur laquelle nous nous trouvons / effet de rechargement pour le user
        return $this->redirectToRoute($routeName, $routeInfos);
        // Cette méthode ne suffit pas pour le changement de langue, un eventSubscriber écoute l'event de changement
        // de l'attribut _locale => cf EventSubsciber/LocalSubscriber.php
    }

    /**
     * @Route("/email")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('jenny.test4php@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html($this->renderView('newEmail.html.twig'));

        $mailer->send($email);

        return $this->render('');
    }
}
