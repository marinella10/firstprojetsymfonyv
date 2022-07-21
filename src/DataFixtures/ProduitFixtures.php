<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produits;
use Faker;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    //Instance de la classe faker
        $faker = Faker\Factory::create ('fr_FR');
        // Un variable sotck un tableau de valeur
        $produits= array();
        //Boucle pour 20 faux articles
        for ($i = 0; $i < 100; $i++) {
            //Instance de la classe Articles
            $produits[$i] = new Produits();
            // Jeu de fausse donnees champ par champ

            //Le tableau -> le mutateur (setter de article entity) + (parametres faker)
            $produits[$i]->setNomProduit($faker->word);
            $produits[$i]->setDescriptionProduit($faker->sentence($nbWord = 6, $variableNbWords = true));
            $produits[$i]->setImageProduit("https://picsum.photos/350");
            $produits[$i]->setStockProduit("true");
            $produits[$i]->setDateProduit($faker->dateTime($max = 'now', $timezone = null));
            $produits[$i]->setPrixProduit($faker->randomFloat($nbMaxDecimals = Null, $min = 0, $max = Null));
            // Entity manager  de Doctrine va faire persister les fausses données
            $manager->persist($produits[$i]);

        }
    $manager->flush();
    }
}