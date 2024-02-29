<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
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
    public function panier(Request $request,EntityManagerInterface $entityManager,  DetailRepository $detailRepo): Response
    {      
        // on recupere la session de la requête:   
        $session=$request->getSession();
        $panier=$session->get('panier',[]);

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
        $this->logger->debug('Page Panier');
        return $this->render('utilisateur/panier.html.twig', [
        'plats' => $tablePlats,
        'vide' => empty($tablePlats), 
        'panier'=>'votre panier est vide',
        'total'=>$total
        ]);
       
    }
}
// <?php

// namespace App\Controller;

// use App\Entity\Detail;
// use App\Repository\PlatRepository;
// use App\Repository\DetailRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class PanierController extends AbstractController
// {
 
//     private $platRepo;
//     public function __construct(PlatRepository $platRepo){
//         $this->platRepo = $platRepo;

//     }
//     #[Route('/panier', name: 'app_panier')]
//     public function panier(Request $request,EntityManagerInterface $entityManager,  DetailRepository $detailRepo): Response
//     {      
                  
//         $session=$request->getSession();
//         $panier=$session->get('panier',[]);
//         $plat="";
//         if($request->query->get('id')) { 

//             $id = $request->query->get('id');
//             $plat=$this->platRepo->find($id); 
       
//             // Vérifie si le plat existe
//             if ($plat) {
//                 // Récupère  détail en base de données
//                 if($detailRepo->findOneBy(['plats' => $id])){ 
//                 $detail = $detailRepo->findOneBy(['plats' => $id]);
//                 // Si aucun détail n'existe pour ce plat, crée-en un nouveau
//                 }else{
//                     $detail = new Detail(); 

//                     // Ajoute le plat au détail:
//                     $detail->setPlats($plat);

//                     // ajout de detail dans  session:
//                     $iddetail=$detail->getId();
//                     $session->set('iddetail', $iddetail);

//                 }
//                 // +1 dans quantite:
//                 $qty=$detail->getQuantite();
//                 $newQty=$qty+1;
//                 $detail->setQuantite($newQty);

//                 // Enregistre les modifications en base de données:
//                 $entityManager->persist($detail);
//                 $entityManager->flush();
//             }    
       
//         }
        
//         if($session->get('iddetail')){ 
//             $iddetail=$session->get('iddetail');
//                 $detail=$detailRepo->findOneBy(['id'=>$iddetail]);
//                     $idplat=$detail->getPlats();
//                     $plat=$this->platRepo->findOneBy(['id'=>$idplat]);
            
             
//         }
//         if(!$plat==""){
//             return $this->render('utilisateur/panier.html.twig', [
//                 "plt"=>$plat
//             ]);
//         }
//         elseif($session->get('iddetail')){
//             $iddetail=$session->get('iddetail');
//                 $detail=$detailRepo->findOneBy(['id'=>$iddetail]);
//                     $idplat=$detail->getPlats();
//                     $plat=$this->platRepo->findOneBy(['id'=>$idplat]);
//             return $this->render('utilisateur/panier.html.twig', [
//                 "plt"=>$plat
//             ]);
        
//         }else{
//             return $this->render('utilisateur/panier.html.twig', [
//                 "vide"=>"Votre Panier est vide.",
//                 "plt"=>$plat
//             ]);
        
//         }
       
//     }
// }
