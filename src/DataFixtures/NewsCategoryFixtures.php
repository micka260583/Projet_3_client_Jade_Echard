<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\NewsCategory;
use App\Service\Slugify;

class NewsCategoryFixtures extends Fixture
{
    public function __construct(Slugify $slug)
    {
        $this->slug = $slug;
    }

    private const NEWSCATEGORIES = [
        'expositions' => 'exhibitions',
        'prix' => 'awards',
        'conferences' => 'conferences',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::NEWSCATEGORIES as $categoryNameFr => $categoryNameEn) {
            $newsCategory = new NewsCategory();
            $categoryFr = $categoryNameFr;
            $categoryEn = $categoryNameEn;

            $newsCategory->setNameFr($categoryFr);
            $newsCategory->setNameEn($categoryEn);
            $newsCategory->setSlug($this->slug->generate($newsCategory->getNameEn()));

            $manager->persist($newsCategory);
            $this->addReference('newsCategories_' . $categoryNameFr, $newsCategory);
        }

        $manager->flush();
    }
}
