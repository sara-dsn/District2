<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormulaireController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('formulaire/contact.html.twig', [
        ]);
    }
    #[Route('/commande', name: 'app_commande')]
    public function commande(): Response
    {
        return $this->render('formulaire/commande.html.twig', [
        ]);
    }
    
}
