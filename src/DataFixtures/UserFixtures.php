<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $password = $this->encoder->encodePassword($user, 'password');

        $user
            ->setEmail('user@user.com')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }
}