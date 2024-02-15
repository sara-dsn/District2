<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(): Response
    {
        return $this->render('accueil/accueil.html.twig', [
        ]);
    }
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(): Response
    {
        return $this->render('accueil/categorie.html.twig', [
        ]);
    }
    #[Route('/plat', name: 'app_plat')]
    public function plat(): Response
    {
        return $this->render('accueil/plat.html.twig', [
        ]);
    }
}
