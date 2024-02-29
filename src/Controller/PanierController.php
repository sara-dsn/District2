<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierController extends AbstractController
{    
    private $logger;
    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }
    #[Route('/panier', name: 'app_panier')]
    public function panier(Request $request, SessionInterface $session): Response
    {   

        if($session->get('panier')){
            $plat=$session->get('panier');
            $tablePlats=$session->get('tableplat');
            if($tablePlats==null){
                $total=0;
            }
            elseif(count($tablePlats)>1){        
                $total=$tablePlats[count($tablePlats)-1]['prix'];  
            }
            else{
                $total=$tablePlats[0]['prix'];  
            }
            
        };

        // pour message affichage msg d'erreur dans dev.log:
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

// use Psr\Log\LoggerInterface;
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
//     private $logger;
//     public function __construct(PlatRepository $platRepo,LoggerInterface $logger){
//         $this->platRepo = $platRepo;
//         $this->logger = $logger;
//     }
//     #[Route('/panier', name: 'app_panier')]
//     public function panier(Request $request,EntityManagerInterface $entityManager,  DetailRepository $detailRepo): Response
//     {      
//         // on recupere la session de la requête:   
//         $session=$request->getSession();
//         $panier=$session->get('panier',[]);

//         if($request->query->get('id')) { 
//             $id = $request->query->get('id');
//             // si le plat existe dans le panier on garde sa quantité sinon on l'initialise à 0:
//             $panier[$id] = $panier[$id] ?? 0;
//             // puis on l'incrémente:
//             $panier[$id]++;
//             // on conserve le tableau 'panier' dans la session:
//             $session->set('panier', $panier);
//         }
        
//         // on créer un tableau '$plats' et une variable pour stocker le total final:
//         $tablePlats = [];
//         $total=0;
//         foreach ($panier as $id => $quantity) {
//             // avec les id du panier on recupère chaque plat:
//             $plat = $this->platRepo->find($id);
//             $prix=$plat->getPrix()*$quantity;
//             $total=$total+$prix;
//             // si le plat existe on le stock dans le tableau '$plat' créée juste au dessus:
//             if ($plat) {
//             $tablePlats[] = [
//                 'plat' => $plat,
//                 'quantité'=>$quantity,
//                 'prix'=>$prix,
               
//                 ];
//             }
//         }
//         $this->logger->debug('Page Panier');
//         return $this->render('utilisateur/panier.html.twig', [
//         'plats' => $tablePlats,
//         'vide' => empty($tablePlats), 
//         'panier'=>'votre panier est vide',
//         'total'=>$total
//         ]);
       
//     }
// }
