<?php

namespace App\DataFixtures;

use App\Entity\Plat;
use App\Entity\User;
use App\Entity\Commande;
use App\Entity\Categorie;
use DateTime;
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

        $rick=new User();
        $rick->setEmail("rick@gmail.com");
        $rick->setRoles(['ROLE_ADMIN']);
        $rick->setPassword('$2y$13$3p9sd5lj2zwJDstzb95TuOsA9/ipgZTHuFwYA8DBQ0LpYTtYKvA3S');
        $rick->setIsVerified(1);
        $manager->persist($rick);
        $manager->flush();

        $morty=new User();
        $morty->setEmail("morty@gmail.com");
        $morty->setRoles(['ROLE_ADMIN']);
        $morty->setPassword('$2y$13$0rqMYlnMj/FvsT.eBOr2wuPtzVZyOTxmaj6Ht6kq/vZvefZDqlwrG');
        $morty->setIsVerified(1);
        $manager->persist($morty);
        $manager->flush();

        $date1=new DateTime('2024-01-14');
        $date2=new DateTime('2024-02-22');
        $date3=new DateTime('2024-02-29');


        $commande1= new Commande();
        $commande1->setDateCommande($date1);
        $commande1->setTotal("8.00");
        $commande1->setEtat(3);
        $commande1->setUtilisateur($rick);
        $manager->persist($commande1);
        $manager->flush();

        $commande2= new Commande();
        $commande2->setDateCommande($date2);
        $commande2->setTotal("16.00");
        $commande2->setEtat(3);
        $commande2->setUtilisateur($rick);
        $manager->persist($commande2);
        $manager->flush();

        $commande3= new Commande();
        $commande3->setDateCommande($date3);
        $commande3->setTotal("11.50");
        $commande3->setEtat(2);
        $commande3->setUtilisateur($morty);
        $manager->persist($commande3);
        $manager->flush();
    }
}
