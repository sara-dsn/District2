<?php

namespace App\Controller;

use App\Form\CommandeType;
use Psr\Log\LoggerInterface;
use App\service\panierservice;
use App\Repository\PlatRepository;
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
        $session=$request->getSession();
        $email=$session->get('_security.last_username',[]);
        $panier=$session->get('panier',[]);
        $user=$request->getUser();
        $form=$this->createForm(CommandeType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // sendmail
        }

        $classe= new panierservice( $PlatRepo, $Logger);
        $fonction=$classe->list($request);
        
        $total=$fonction['total'];
        $tablePlat=$fonction['tablePlat'];


        return $this->render('formulaire/commande.html.twig', [
            'total'=>$total,
            'plats'=>$tablePlat,
            'vide'=>empty($tablePlat),
            'panier'=>'Votre Panier est vide',
            'commande'=>$form->createView(),
        ]);
    }
}
