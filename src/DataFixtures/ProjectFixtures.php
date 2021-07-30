<?php

namespace App\DataFixtures;

use App\Entity\Galery;
use App\Entity\GaleryCollection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Service\Slugify;
use App\Entity\Project;
use App\Entity\Image;
use App\Entity\ProjectCategory;
use DateTime;

class ProjectFixtures extends Fixture
{
    private const PROJECTCAT = [
        'produits' => 'products',
        'art de la table' => 'tableware',
        'bijoux / maroquinerie' => 'accessories',
        'luminaires' => 'lightings',
        'mobilier' => 'furnitures',
        'design social' => 'social design',
    ];

    public function __construct(Slugify $slug)
    {
        $this->slug = $slug;
    }

    public function load(ObjectManager $manager)
    {
       /* $date = new DateTime('09/06/2020');
        $date->format('Y-m-d');

        $projects = [
            [
                'title' => 'Keep Heat',
                'subtitleFr' => 'Verre',
                'subtitleEn' => 'Glass',
                'descriptionFr' => 'Contenant isotherme thermo-sensible pour la marque Tefal.
                La double paroi isotherme permet à l’utilisateur de garder au chaud ou au frais sa boisson.
                L’encre thermochromique qui se trouve entre les deux surfaces indique la température de la boisson.',
                'descriptionEn' => 'Thermo-sensitive isothermal container for the Tefal brand.
                The double-walled insulated container allows the user to keep his drink hot or cool.
                The thermochromic ink between the two surfaces indicates the temperature of the drink.',
                'image' => 'images/293f.png'
            ],
            [
                'title' => 'Memori',
                'subtitleFr' => 'Ladurée',
                'subtitleEn' => 'Ladurée',
                'descriptionFr' => 'Création de flacons de parfum sur le thème de la mémoire pour la marque Ladurée,
                maison chargée d’histoire, symbole de l’Art de vivre et du luxe à la française. Les flacons sont
                inspirés des bouteilles de parfum anciennes et de l’architecture ornementée des boutiques Ladurée.',
                'descriptionEn' => 'Creation of perfume bottles on the theme of memory for the Ladurée brand,
                a house steeped in history and a symbol of French art de vivre and luxury. The bottles are inspired by
                old perfume bottles and the ornamented architecture of Ladurée boutiques.',
                'image' => 'images/293f.png'
            ],
            [
                'title' => 'Shower to go',
                'subtitleFr' => 'PLA, papier',
                'subtitleEn' => 'PLA, paper',
                'descriptionFr' => 'Dispositif de douche nomade pour offrir hygiène et confort dans un contexte de
                randonnée sauvage ou dans des conditions rudimentaires, "hors réseau". Facilite le transport de l’eau
                d’une source à son lieu de vie, grâce au système de gonflement de la poche en plastique,
                souple et transparente.',
                'descriptionEn' => 'Nomadic shower device to offer hygiene and comfort in the context of wilderness
                hiking or in rudimentary conditions, "off the grid". Facilitates the transport of water from a source
                to its place of life, thanks to the system of inflation of the plastic bag, flexible and transparent.',
                'image' => 'images/293f.png'
            ],
            [
                'title' => 'Ostra',
                'subtitleFr' => 'Des déchets au design',
                'subtitleEn' => 'From waste to resource',
                'descriptionFr' => 'OSTRA vise à revaloriser les déchets ostréicoles en développant une
                gamme de produits d’arts de la table à partir de ce biomatériau local et durable
                dans un contexte d’économie circulaire.',
                'descriptionEn' => 'OSTRA aims to revalue oyster farming waste by developing
                a range of tableware products from this local and sustainable biomaterial
                in a circular economy context.',
                'image' => 'images/293f.png'
            ],
            [
                'title' => 'Dohl',
                'subtitleFr' => 'Boucles d\'oreilles',
                'subtitleEn' => 'Earings',
                'descriptionFr' => 'Création d’une collection de bijoux pour la marque
                & Other Stories sur le thème de l’animalité.',
                'descriptionEn' => 'Creation of a jewelry collection for the brand
                & Other Stories on the theme of animality.',
                'image' => 'images/293f.png'
            ],
        ]; */

        foreach (self::PROJECTCAT as $projectCatFr => $projectCatEn) {
            $projectCat = new ProjectCategory();
            $projectCategoryFr = $projectCatFr;
            $projectCategoryEn = $projectCatEn;
            $projectCat->setNameFr($projectCategoryFr);
            $projectCat->setNameEn($projectCategoryEn);
            $projectCat->setSlug($this->slug->generate($projectCat->getNameEn()));

            $manager->persist($projectCat);
        }

        /* foreach ($projects as $key => $data) {
            // Illustrations project
            $image = new Image();
            $image->setImageLink($data['image']);
            $image->setUpdatedAt(new DateTime('now'));
            $manager->persist($image);
            $manager->flush();

            // Project
            $project = new Project();
            $project->setTitle($data['title']);
            $project->setSlug($this->slug->generate($project->getTitle()));
            $project->setSubtitleFr($data['subtitleFr']);
            $project->setSubtitleEn($data['subtitleEn']);
            $project->setProjectDate($date);
            $project->setMainIllustration($image);
            $project->setSecondIllustration($image);
            $project->setProjectCategory($projectCat);
            $project->setMoreInfoLink('https://www.figma.com/file/dYmnx83Tn98eFW19nkU4mX/JEED?node-id=0%3A1');
            $project->setExhibitionLogo($image);
            $project->setOtherLogo($image);
            $project->setOtherPicto($image);
            $project->setProjectDate($date);
            $project->setDescriptionFr($data['descriptionFr']);
            $project->setDescriptionEn($data['descriptionEn']);

            // Galery
            $galery = new Galery();
            $galery->setTitle('Titre Galery')->setSubtitle('Sous-titre Galery')->setProject($project);
            $manager->persist($galery);

            // Collections
            $collection = new GaleryCollection();
            $collection->setTitle('Dune');
            $collection->setDescriptionFr('Dune est la première collection de vaisselle du projet OSTRA faite à
            partir d’une recette antique mélangeant des déchets coquilliers, du sable et de l’eau de mer.
            Les formes sont inspirées par le paysage de bord de mer et ses lignes pures.');
            $collection->setDescriptionEn('Dune is the first tableware collection of the OSTRA project made from an
            ancient recipe mixing shell waste, sand and sea water. The shapes are inspired by the seaside
            landscape and its pure lines.');
            $collection->setGalery($galery);

            $collection2 = new GaleryCollection();
            $collection2->setTitle('Tide');
            $collection2->setDescriptionFr('Tide est la deuxième collection de vaisselle du projet OSTRA faite à partir
            de coquilles d’huîtres. Cette collection s’inspire de la forme organique de la coquille et
            des marées qui leur permettent de croître.');
            $collection2->setDescriptionEn('Tide is the second collection of tableware from the OSTRA project made
            from oyster shells. This collection is inspired by the organic shape of the shell and the
            tides that allow them to grow.');
            $collection2->setGalery($galery);

            for ($i = 0; $i < 10; $i++) {
                $imageCollection1 = new Image();
                $imageCollection1->setImageLink('images/293f.png');
                $imageCollection1->setUpdatedAt(new DateTime('now'));
                $manager->persist($imageCollection1);

                $imageCollection2 = new Image();
                $imageCollection2->setImageLink('images/293f.png');
                $imageCollection2->setUpdatedAt(new DateTime('now'));
                $manager->persist($imageCollection1);

                $collection->addImage($imageCollection1);
                $collection2->addImage($imageCollection2);
            }

            $manager->persist($collection);
            $manager->persist($collection2);

            $project->setGalery($galery);

            $manager->persist($project);
            $this->addReference('project_' . $key, $project);
        }*/

        $manager->flush();
    }
}
