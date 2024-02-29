<?php

namespace App\service;

use Psr\Log\LoggerInterface;
use App\Repository\PlatRepository;
use App\Repository\DetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class panierservice extends AbstractController
{    
    private $platRepo;
    private $logger;
    public function __construct(PlatRepository $platRepo,LoggerInterface $logger){
        $this->platRepo = $platRepo;
        $this->logger = $logger;
    }
    public function list(Request $request){ 
        // on recupere la session de la requête:   
        $session=$request->getSession();
        $panier=$session->get('panier',[]);
        return $this->render('utilisateur/panier.html.twig', []);

    }
    public function add(Request $request, SessionInterface $session){
        if($request->query->get('id')) { 
            $id = $request->query->get('id');
            // si le plat existe dans le panier on garde sa quantité sinon on l'initialise à 0:
            $panier[$id] = $panier[$id] ?? 0;
            // puis on l'incrémente:
            $panier[$id]++;
            // on conserve le tableau 'panier' dans la session:
            $session->set('panier', $panier);
        }   
        // on créer un tableau '$plats' et une variable pour stocker le total final:
        $tablePlats = [];
        $total=0;
        foreach ($panier as $id => $quantity) {
            // avec les id du panier on recupère chaque plat:
            $plat = $this->platRepo->find($id);
            $prix=$plat->getPrix()*$quantity;
            $total=$total+$prix;
            // si le plat existe on le stock dans le tableau '$plat' créée juste au dessus:
            if ($plat) {
            $tablePlats[] = [
                'plat' => $plat,
                'quantité'=>$quantity,
                'prix'=>$prix,
               
                ];
            }
        } 
        $session->set('tableplat',$tablePlats);
    }
    public function remove(Request $request, SessionInterface $session){
        // je recupere l'id du lien:
        $id=$request->query->get('id');
        // je cherche le plat correspondant à l'id:
        $prix=$this->platRepo->get($id)->getPrix();

        $platAsupp=$session->get('panier'[$id]);
        $suppPlat=$platAsupp->getQuantite()-1;
        $suppPrix=$platAsupp->getPrix()-$prix;

    }
        
        
       
        
   
     
       
    
}
