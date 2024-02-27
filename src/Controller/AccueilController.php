<?php

namespace App\Controller;

use App\Entity\Detail;
use App\Repository\PlatRepository;
use App\Repository\DetailRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    private $detailRepo;
    private $categorieRepo;
    private $platRepo;
    public function __construct(CategorieRepository $categorieRepo, PlatRepository $platRepo, DetailRepository $detailRepo){
        $this->categorieRepo = $categorieRepo;
        $this->platRepo = $platRepo;
        $this->detailRepo =$detailRepo;

    }
    #[Route('/', name: 'app_accueil')]
    public function accueil(): Response
    {
        $categorie=$this->categorieRepo->findBy( ['active'=>1], null ,$limit='6');
        $plat=$this->platRepo->findBy( ['active'=>1], null ,$limit='3');
        $platsm=$this->platRepo->findBy( ['active'=>1], null ,$limit='6');

        return $this->render('accueil/accueil.html.twig', [
            'categorie'=>$categorie,
            'plat'=>$plat,
            'platsm'=>$platsm

        ]);
    }
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(): Response
    {
        $categorie=$this->categorieRepo->findBy( ['active'=>1], null ,$limit='6');

        return $this->render('accueil/categorie.html.twig', [
        'categorie'=>$categorie
        ]);
    }
    #[Route('/plat', name: 'app_plat')]
    public function plat(): Response
    {
        $plt=$this->platRepo->findBy( ['active'=>1], null ,$limit='6');
        return $this->render('accueil/plat.html.twig', [
            'plat'=>$plt
        ]);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('formulaire/contact.html.twig', [
        ]);
    }
    #[Route('/commande', name: 'app_commande')]
    public function commande(): Response
    {
        return $this->render('formulaire/commande.html.twig', [
        
        ]);
    }
    #[Route('/politique', name: 'app_politique')]
    public function politique(): Response
    {
        return $this->render('RGPD/politique.html.twig', [
        ]);
    }
    #[Route('/mention', name: 'app_mention')]
    public function mention(): Response
    {
        return $this->render('RGPD/mention.html.twig', [
        ]);
    }
    #[Route('/livreur', name: 'app_livreur')]
    public function livreur(): Response
    {
        return $this->render('message/livreur.html.twig', [
        ]);
    }
    #[Route('/demande', name: 'app_demande')]
    public function demande(): Response
    {
        return $this->render('message/demande.html.twig', [
        ]);
    }
    
}
