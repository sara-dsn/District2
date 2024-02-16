<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    #[Route('/connection', name: 'app_connection')]
    public function connection(EntityManagerInterface $manager): Response
    {
        
        $form=$this->createForm(UserFormType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $user =new User();
            $data = $form->getData();
            $user =$data;
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('utilisateur/connection.html.twig', [
            'formulaire' =>$form 
        ]);
    }


    #[Route('/panier', name: 'app_panier')]
    public function panier(): Response
    {
        return $this->render('utilisateur/panier.html.twig', [
        ]);
    }
    // public function index(UserPasswordHasher $passwordHasher):Response 
    // {

    // }
}
