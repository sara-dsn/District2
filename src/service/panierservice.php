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
        return $this->redirectToRoute('app_panier');

    }

    public function add(Request $request, SessionInterface $session){
        if($request->attributes->get('id')) { 
            $id = $request->attributes->get('id');
            // si le plat existe dans le panier on garde sa quantité sinon on l'initialise à 0:
            $panier[$id] = $panier[$id] ?? 0;
            // puis on l'incrémente:
            $panier[$id]++;
            // on conserve le tableau 'panier' dans la session:
            $session->set('panier', $panier);
        }   
        return $this->redirectToRoute('app_panier');

    }
    
    public function remove(Request $request, SessionInterface $session){
        // je recupere l'id du lien:
        $id=$request->attributes->get('id');
        $panier=$session->get('panier',[]);

        foreach($panier as $idd => $quantity){
            if($id == $idd){
                $quantity-- ;
                if($quantity==0) {
                    unset($panier[$id]);
                }else{
                    $panier[$idd]=$quantity;
                }
            }
        }
   $session->set('panier',$panier);
        return $this->redirectToRoute('app_panier', [
        ]);
    }  
    public function delete(Request $request, SessionInterface $session){
        $id=$request->attributes->get('id');
        $panier=$session->get('panier',[]);

        if($panier[$id]){
            unset($panier[$id]);
        };
        $session->set('panier',$panier);
        return $this->redirectToRoute('app_panier');
    }
}
