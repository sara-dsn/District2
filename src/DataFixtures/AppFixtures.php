<?php

namespace App\DataFixtures;

use App\Entity\Plat;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dessert = new Categorie();
        $dessert->setLibelle("Dessert") ;
        $dessert->setImage("dessert.webp");
        $dessert->setActive(1);
        $manager->persist($dessert);
        $manager->flush();

        $froid = new Categorie();
        $froid->setLibelle("Boisson froide") ;
        $froid->setImage("boisson_froide.webp");
        $froid->setActive(1);
        $manager->persist($froid);
        $manager->flush();

        $chaud = new Categorie();
        $chaud->setLibelle("Boisson chaude") ;
        $chaud->setImage("boisson_chaude.webp");
        $chaud->setActive(1);
        $manager->persist($chaud);
        $manager->flush();

        $banana = new Plat();
        $banana->setLibelle("Banana Split") ;
        $banana->setImage("bananaSplit.webp");
        $banana->setActive(1);
        $banana->setDescription("Succomber au classique banana split composé de banane, boule de sorbet fraise, boule de glace vanille, boule de glace chocolat, sauce chocolat chaud, crème fouettée et ses éclats croquant de noix pécan enrobé de chocolat.");
        $banana->setPrix(6);
        $banana->setCategorie($dessert);
        $manager->persist($banana);
        $manager->flush();

        $latte = new Plat();
        $latte->setLibelle("Café latte ") ;
        $latte->setImage("cafe_latte.webp");
        $latte->setActive(1);
        $latte->setDescription("L'intensité de notre espresso rencontre la douceur du lait chauffé à la vapeur, le tout recouvert d'une fine couche de mousse de lait. ");
        $latte->setPrix(3,50);
        $latte->setCategorie($chaud);
        $manager->persist($latte);
        $manager->flush();

        $matcha = new Plat();
        $matcha->setLibelle("Frappuccino Matcha") ;
        $matcha->setImage("Frappuccion_matcha.webp");
        $matcha->setActive(1);
        $matcha->setDescription("Essayez votre Matcha préféré dans un Frappuccino - Le Matcha est combiné avec du lait , une sauce saveur chocolat,  et de la vanille et garni de crème fouettée. ");
        $matcha->setPrix(4,50);
        $matcha->setCategorie($dessert);
        $manager->persist($matcha);
        $manager->flush();

        $caramel = new Plat();
        $caramel->setLibelle("Iced Caramel Macchiato") ;
        $caramel->setImage("iced_caramel_macchiato.webp");
        $caramel->setActive(1);
        $caramel->setDescription("Du lait saveur vanille taché d'un espresso surmonté d'un nappage saveur caramel, servi glacé.");
        $caramel->setPrix(4,50);
        $caramel->setCategorie($froid);
        $manager->persist($caramel);
        $manager->flush();

        $mojito = new Plat();
        $mojito->setLibelle("Virgin Mojito") ;
        $mojito->setImage("virgin_mojito.webp");
        $mojito->setActive(1);
        $mojito->setDescription("Un cocktail mojito à la menthe fraîche et au citron sans alcool, à consommer sans modération!");
        $mojito->setPrix(4);
        $mojito->setCategorie($froid);
        $manager->persist($mojito);
        $manager->flush();
    }
}
