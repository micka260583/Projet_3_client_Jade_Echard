<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Press;
use App\Entity\Image;
use DateTime;


class PressFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $date = new DateTime('09/06/2020');

        $press = [
            [
                'date' => $date,
                'linkPress' => 'https://www.figma.com/file/dYmnx83Tn98eFW19nkU4mX/JEED?node-id=5%3A14',
            ],
            [
                'date' => $date,
                'linkPress' => 'https://www.figma.com/file/dYmnx83Tn98eFW19nkU4mX/JEED?node-id=5%3A14',
            ],
            [
                'date' => $date,
                'linkPress' => 'https://www.figma.com/file/dYmnx83Tn98eFW19nkU4mX/JEED?node-id=5%3A14',
            ],
            [
                'date' => $date,
                'linkPress' => 'https://www.figma.com/file/dYmnx83Tn98eFW19nkU4mX/JEED?node-id=5%3A14',
            ],
        ];

        foreach ($press as $key => $data) {
            $image = new Image();
            $image->setImageLink('https://zupimages.net/up/21/24/103u.png');
            $manager->persist($image);
            $imageMedia = new Image();
            $imageMedia->setImageLink('http://static.dezeen.com/assets/images/logo-magazine.png');
            $manager->persist($imageMedia);
            $press = new Press();
            $press->setTitle('TitrePress');
            $press->setCreatedAt($data['date']);
            $press->setLinkPress($data['linkPress']);
            $press->setIllustration($image);
            $press->setLogoMedia($imageMedia);
            $manager->persist($press);
        }

        $manager->flush();
    }
}
