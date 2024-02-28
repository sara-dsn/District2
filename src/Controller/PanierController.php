<?php

namespace App\Controller;

use App\Entity\Detail;
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
    public function __construct(PlatRepository $platRepo){
        $this->platRepo = $platRepo;

    }
    #[Route('/panier', name: 'app_panier')]
    public function panier(Request $request,EntityManagerInterface $entityManager,  DetailRepository $detailRepo): Response
    {                
        $session=$request->getSession();
        $plat="";
        if($request->query->get('id')) { 

            $id = $request->query->get('id');
            $plat=$this->platRepo->find($id); 
       
            // Vérifie si le plat existe
            if ($this->platRepo->find($id)) {
                // Récupère  détail en base de données
                if($detailRepo->findOneBy(['plats' => $id])){ 
                $detail = $detailRepo->findOneBy(['plats' => $id]);
                // Si aucun détail n'existe pour ce plat, crée-en un nouveau
                }else{
                    $detail = new Detail(); 

                    // Ajoute le plat au détail:
                    $detail->setPlats($plat);

                    // ajout de detail dans  session:
                    $iddetail=$detail->getId();
                    $session->set('iddetail', $iddetail);

                }
                // +1 dans quantite:
                $qty=$detail->getQuantite();
                $newQty=$qty+1;
                $detail->setQuantite($newQty);

                // Enregistre les modifications en base de données:
                $entityManager->persist($detail);
                $entityManager->flush();
            }    
       
        }
        
        if($session->get('iddetail')){ 
            $iddetail=$session->get('iddetail');
            if($iddetail){
                $detail=$detailRepo->findOneBy(['id'=>$iddetail]);
            if($detail){
                $idplat=$detail->getPlats();
                $plat=$this->platRepo->findOneBy(['id'=>$idplat]);
            }}
             
        }
        if(!$plat==""){
            return $this->render('utilisateur/panier.html.twig', [
                "plt"=>$plat
            ]);
        }else{
            return $this->render('utilisateur/panier.html.twig', [
                "vide"=>"Votre Panier est vide.",
                "plt"=>$plat
            ]);
        
        }
       
    }
}
