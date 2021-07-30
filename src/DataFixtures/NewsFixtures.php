<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\News;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class NewsFixtures extends Fixture implements DependentFixtureInterface
{

    private const NEWSTITRE = [
        'News1' => 'News1',
        'News2' => 'News2',
        'News3' => 'News3',
    ];

    public function load(ObjectManager $manager)
    {
        $date = '09.06.2020';
        $link = ('https://www.figma.com/file/dYmnx83Tn98eFW19nkU4mX/JEED?node-id=5%3A14');

        foreach (self::NEWSTITRE as $newsTitleFr => $newsTitleEn) {
            $image = new Image();
            $image->setImageLink('https://lesjours.fr/img/les-jours-c-quoi/revue-de-presse/presse-news.jpg');
            $manager->persist($image);

            $news = new News();
            $newsFr = $newsTitleFr;
            $newsEn = $newsTitleEn;
            $news->setTitleFr($newsFr);
            $news->setTitleEn($newsEn);
            $news->setDescriptionFr('Biotours Talk . Dutch Design Week');
            $news->setDescriptionEn('Biotours Talk . Dutch Design Week');
            $news->setPlayOn($date);
            $news->setLink($link);
            $news->setIllustration($image);
            $news->setNewsCategory($this->getReference('newsCategories_expositions'));

            $manager->persist($news);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          NewsCategoryFixtures::class,
        ];
    }
}
