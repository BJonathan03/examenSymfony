<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Cocktails;
use App\Entity\Ingredients;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CocktailsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // Création de 5 catégories

        for($i = 0; $i <=4; $i++){
            $categorie = new Categories();

            $categorie->setNom($faker->sentence(2, true))
                      ->setDescription($faker->sentence(2));

            $manager->persist($categorie);

            for($j = 0; $j <= mt_rand(0, 5); $j++){
                $cocktail = new Cocktails();
                $cocktail->setNom($faker->sentence(2, true))
                         ->setDescription($faker->paragraph( 3, true ))
                         ->setPrix($faker->randomDigitNotNull)
                         ->setVolume($faker->numberBetween($min = 4, $max = 50))
                         ->setOrigine($faker->country)
                         ->setImageUrl($faker->imageUrl(300, 180))
                         ->setCategories($categorie);


                $manager->persist($cocktail);

                for($k = 0; $k <= mt_rand(2, 5); $k++) {
                    $ingredient = new Ingredients();
                    $ingredient->setNom($faker->word)
                        ->setDescription($faker->sentence(2, true));

                    $ingredient->addCocktail($cocktail);

                    $manager->persist($ingredient);
                 }
            }

        }

        $manager->flush();
    }
}
