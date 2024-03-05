<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use App\service\panierservice;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    private $Logger;
    private $PlatRepo;
    public function __construct(PlatRepository $PlatRepo, LoggerInterface $Logger)
    {
        $this->PlatRepo = $PlatRepo;
        $this->Logger = $Logger;
    }

    #[Route('/commande', name: 'app_commande')]
    public function commande(Request $request, PlatRepository $PlatRepo , LoggerInterface $Logger): Response
    {
        $classe= new panierservice( $PlatRepo, $Logger);
        $fonction=$classe->list($request);
        
        $total=$fonction['total'];
        $tablePlat=$fonction['tablePlat'];


        return $this->render('formulaire/commande.html.twig', [
            'total'=>$total,
            'plats'=>$tablePlat,
            'vide'=>empty($tablePlat),
            'panier'=>'Votre Panier est vide',
        
        ]);
    }
}
