<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/connection', name: 'app_connection')]
    public function connection(): Response
    {
        return $this->render('utilisateur/connection.html.twig', [
        ]);
    }
    #[Route('/panier', name: 'app_panier')]
    public function panier(): Response
    {
        return $this->render('utilisateur/panier.html.twig', [
        ]);
    }
}
