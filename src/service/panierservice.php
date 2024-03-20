<?php

namespace App\service;

use Psr\Log\LoggerInterface;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class panierservice extends AbstractController
{    
    private $platRepo;
    private $logger;
    public function __construct(PlatRepository $platRepo,LoggerInterface $logger){
        $this->platRepo = $platRepo;
        $this->logger = $logger;
    }
// Affiche le panier:
    public function list(Request $request){ 
        // on recupere la session de la requête:   
        $session=$request->getSession();
        $panier=$session->get('panier',[]);

        // on créer un tableau '$plats' et une variable pour stocker le total final:
        $tablePlats = [];
        $total=0;
        foreach ($panier as $id => $quantity) {
            // avec les id du panier on recupère chaque plat:
            $plat = $this->platRepo->find($id);
            // var_dump($panier);
            // var_dump($id);
            // var_dump($quantity);
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
     
        return [ 
            'tablePlat'=>$tablePlats,
            'total'=>$total,
        ];

    }
// Ajouter un plat au panier:
        public function add(Request $request){ 
            $id=$request->attributes->get('id');
            $session=$request->getSession();            
            $panier=$session->get('panier',[]);
   
        if($request->attributes->get('id')) { 
           
            // si le plat existe dans le panier on garde sa quantité sinon on l'initialise à 0:
            $panier[$id] = $panier[$id] ?? 0;
            // puis on l'incrémente:
            $panier[$id]++;
            // on conserve le tableau 'panier' dans la session:
            $session->set('panier', $panier);
        }   
        return $this->redirectToRoute('app_panier');

    }
// Retire un plat du panier:
    // public function remove(Request $request, SessionInterface $session){ // test debug
        public function remove(Request $request){
        // je recupere l'id du lien:
        $id=$request->attributes->get('id');
        $session=$request->getSession();     // test debug
        $panier=$session->get('panier',[]);

        foreach($panier as $idd => $quantity){
            if($id == $idd){
                $quantity-- ;
                if($quantity==0) {
                    unset($panier[$idd]);
                }
                else{
                    $panier[$idd]=$quantity;   
                    $session->set('panier',$panier);

                }
            }
        }
        return $this->redirectToRoute('app_panier', [
        ]);
    }  
// Supprime un plat du panier:
    // public function delete(Request $request, SessionInterface $session){ // test debug
        public function delete(Request $request){
        $id=$request->attributes->get('id');
        $session=$request->getSession();     // test debug
        $panier=$session->get('panier',[]);

        if($panier[$id]){
            unset($panier[$id]);
        };
        $session->set('panier',$panier);
        return $this->redirectToRoute('app_panier');
    }
// // Envoyer un mail de confirmation de commande:
//     public function sendEmail(MailerInterface $modelMail,Security $security,  $panier, $adresseLivraison): Response
//         {

//                   // Récupere l'email de l'utilisateur:
//         $user=$security->getUser();
//         $email=$user->getUserIdentifier();           
//             var_dump($email);
//             $liste="";
// foreach($panier as $id=>$quantity){
//     $plat=$this->platRepo->find($id)->getLibelle();
// $liste=$liste." ".$quantity." ".$plat." et ";
// }
//             $email = (new TemplatedEmail())
//                 ->from('The_District@gmail.com')
//                 ->to($email)
//                 //->cc('cc@example.com')
//                 //->bcc('bcc@example.com')
//                 //->replyTo('fabien@example.com')
//                 //->priority(Email::PRIORITY_HIGH)
//                 ->subject('Votre Commande est en préparation !')
//                 ->html("Merci d'avoir commander chez nous ! Le livreur vous contactera quand il récéptionnera votre commande de ".$liste." <br>  il vous la livrera au ".$adresseLivraison." . " );

//             $modelMail->send($email);

//             return new Response(true);
//         }
}
