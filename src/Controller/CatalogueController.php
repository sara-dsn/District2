<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use App\Repository\DetailRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogueController extends AbstractController
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
    public function accueil(Request $request): Response
    {
        $session=$request->getSession();

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
    public function categorie(Request $request): Response
    {
        $session=$request->getSession();

        $categorie=$this->categorieRepo->findBy( ['active'=>1], null ,$limit='6');

        return $this->render('accueil/categorie.html.twig', [
        'categorie'=>$categorie
        ]);
    }
    #[Route('/plat', name: 'app_plat')]
    public function plat(Request $request): Response
    {
        $session=$request->getSession();

        $plt=$this->platRepo->findBy( ['active'=>1], null ,$limit='6');
        return $this->render('accueil/plat.html.twig', [
            'plat'=>$plt
        ]);
    }
  
  
    #[Route('/politique', name: 'app_politique')]
    public function politique(Request $request): Response
    {
        $session=$request->getSession();

        return $this->render('RGPD/politique.html.twig', [
        ]);
    }
    #[Route('/mention', name: 'app_mention')]
    public function mention(Request $request): Response
    {
        $session=$request->getSession();

        return $this->render('RGPD/mention.html.twig', [
        ]);
    }
    #[Route('/livreur', name: 'app_livreur')]
    public function livreur(Request $request): Response
    {
        $session=$request->getSession();

        return $this->render('message/livreur.html.twig', [
        ]);
    }
    #[Route('/demande', name: 'app_demande')]
    public function demande(Request $request): Response
    {
        $session=$request->getSession();

        return $this->render('message/demande.html.twig', [
        ]);
    }
}
