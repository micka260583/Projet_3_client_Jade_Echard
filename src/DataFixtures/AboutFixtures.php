<?php

namespace App\DataFixtures;

use App\Entity\About;
use App\Entity\AboutInfo;
use App\Entity\AboutInfoCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Image;

class AboutFixtures extends Fixture
{
    private const ABOUTINFOCAT = [
        'parcours' => 'background',
        'expositions' => 'exhibitions',
        'prix' => 'awards',
    ];

    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setImageLink('jade-echard-avatar.jpg');
        $manager->persist($image);

        $about = new About();
        $about->setAvatar($image);
        $about->setDescriptionFr(
            'Récemment diplômée, j’ai acquis au cours de mes études et de mes expériences en entreprise
            une vision concrète du métier de designer,
            un sens de l’adaptation, ainsi qu’un bon esprit d’équipe. Passionnée, pragmatique et intuitive,
            je possède également une excellente maîtrise des outils de création.'
        );
        $about->setDescriptionEn('Recently graduated, I acquired during my studies and my experiences in
        company a concrete vision of the designer\'s job, a sense of adaptation, as well as a good team spirit.
        Passionate, pragmatic and intuitive, I also have an excellent mastery of creative tools.');
        $about->setInstagram('https://www.instagram.com/jade.echard/');
        $about->setLinkedin('https://www.linkedin.com/in/jade-echard/');
        $manager->persist($about);

        foreach (self::ABOUTINFOCAT as $aboutInfoCatFr => $aboutInfoCatEn) {
            $aboutInfoCat = new AboutInfoCategory();
            $aboutInfoCat->setNameFr($aboutInfoCatFr);
            $aboutInfoCat->setNameEn($aboutInfoCatEn);
            $manager->persist($aboutInfoCat);

            $aboutInfo = new AboutInfo();
            $aboutInfo->setTitleFr('Lorem');
            $aboutInfo->setTitleEn('Ipsum');
            $aboutInfo->setTiming(2020);
            $aboutInfo->setInfoCategory($aboutInfoCat);
            $manager->persist($aboutInfo);
        }

        $manager->flush();
    }
}
