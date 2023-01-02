<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VideosFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 100; $i++){
            $video = new Video();
            $video->setTitre($faker->word)
                ->setAuteur($this->getReference("auteur".$faker->numberBetween(0,24)))
                ->setCreatedAt($faker->dateTimeBetween("- 1 year"))
                ->setDescription($faker->paragraphs($faker->numberBetween(1,5),true))
                ->setLikes($faker->numberBetween(0,143))
                ->setDislike($faker->numberBetween(0,24));
            $manager->persist($video);
        }

        $manager->flush();
    }
}
