<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\Tag;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $auteur = new Auteur();
        $auteur -> setNom("Tolkien");
        $manager->persist($auteur);

        $article = new Article();
        $article -> setTitre("Le hobbit");
        $article -> setAuteurs($auteur);
        $manager->persist($article);

        
        $tag = new Tag();
        $tag -> setNom("Fantasy");
        $tag -> addArticle($article);
        $manager->persist($tag);

        $manager->flush();
    }
}
