<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       for ($i = 0; $i < 25; $i++){
            $faker = Factory::create("fr_FR");
            $auteur = new Auteur();
            $auteur->setNom($faker->lastName)
                ->setPseudo($faker->word)
                ->setPrenom($faker->firstName)
                ->setCreatedAt($faker->dateTimeBetween("-30 days"));
            $this->setReference("auteur".$i,$auteur);
            $manager->persist($auteur);
       }

        $manager->flush();
    }
}
