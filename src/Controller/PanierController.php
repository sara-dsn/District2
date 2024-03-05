<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\service\panierservice;
use App\Repository\PlatRepository;
use App\Repository\DetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{    
    private $platRepo;
    private $logger;
    public function __construct(PlatRepository $platRepo,LoggerInterface $logger){
        $this->platRepo = $platRepo;
        $this->logger = $logger;
    }
    #[Route('/panier', name: 'app_panier')]
    public function panier(Request $request,LoggerInterface $logger,  PlatRepository $PlatRepo): Response
    { 
        
    //On recupere la focntion pour afficher le panier:  
       $affiche= new panierservice($PlatRepo, $logger);
       $fonction=$affiche->list($request);

    //On recupere les données retournées:
       $total=$fonction['total'];
       $tablePlats=$fonction['tablePlat'];

       return $this->render('utilisateur/panier.html.twig', [
        'plats' => $tablePlats,
        'vide' => empty($tablePlats), 
        'panier'=>'votre panier est vide',
        'total'=>$total
    ]);
       
       
    }
}
