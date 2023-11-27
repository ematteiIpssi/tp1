<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $message1 = new Auteur();
        $manager->persist($message1);
        $manager->flush();
    }
}
