<?php

namespace App\Controller;

use DateTime;
use App\Entity\Commande;
use App\Form\CommandeType;
use Psr\Log\LoggerInterface;
use App\service\panierservice;
use Symfony\Component\Mime\Email;
use App\Repository\PlatRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\EventSubscriber\CommandeSubscriber;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    private $userRepo;
    public function __construct( UserRepository $userRepo)
    {
        $this->userRepo=$userRepo;
    }

    #[Route('/commande', name: 'app_commande')]
    public function commande(EntityManagerInterface $EntityManager, Request $request, PlatRepository $PlatRepo , LoggerInterface $Logger, Security $security): Response
    {
        // Récupere le panier:
        $session=$request->getSession();
        $panier=$session->get('panier',[]);

        // Créer le formulaire:
        $form=$this->createForm(CommandeType::class);
        $form->handleRequest($request);
        
        // Pour afficher le récapitulatif du panier:
        $classe= new panierservice( $PlatRepo, $Logger);
        $fonction=$classe->list($request);
        $total=$fonction['total'];
        $tablePlat=$fonction['tablePlat'];

        // Si le formulaire est envoyé , on envoie le mail de confirmation de commande:
        if($form->isSubmitted() && $form->isValid()){
            // Pour afficher le récapitulatif du panier:
            $classe= new panierservice( $PlatRepo, $Logger);
            $fonction=$classe->list($request);
            $total=$fonction['total'];

            $user=$security->getUser();
            $email=$user->getUserIdentifier();
            $userAuth=$this->userRepo->findOneBy(['email'=>$email],null);
            $id=$userAuth->getId();
            $date=new DateTime('now');

            // On insere dans la base de donné:
            $commande= new Commande();
            $commande->setDateCommande($date);
            $commande->setTotal($total);
            $commande->setEtat(0);
            $commande->setUtilisateur($user);

            $EntityManager->persist($commande);
            $EntityManager->flush();

            return $this->redirectToRoute('app_livreur');
        }

        return $this->render('formulaire/commande.html.twig', [
            'total'=>$total,
            'plats'=>$tablePlat,
            'vide'=>empty($tablePlat),
            'panier'=>'Votre Panier est vide',
            'commande'=>$form->createView(),
        ]);
    }
}
