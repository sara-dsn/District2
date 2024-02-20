<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    private $categorieRepo;
    private $platRepo;
    public function __construct(CategorieRepository $categorieRepo, PlatRepository $platRepo){
        $this->categorieRepo = $categorieRepo;
        $this->platRepo = $platRepo;

    }
    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(): Response
    {
        $categorie=$this->categorieRepo->findAll();
        $plat=$this->platRepo->findAll();
        return $this->render('accueil/accueil.html.twig', [
            'categorie'=>$categorie,
            'plat'=>$plat

        ]);
    }
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(): Response
    {
        $categorie=$this->categorieRepo->findAll();
        return $this->render('accueil/categorie.html.twig', [
        'categorie'=>$categorie
        ]);
    }
    #[Route('/plat', name: 'app_plat')]
    public function plat(): Response
    {
        $plt=$this->platRepo->findAll();
        return $this->render('accueil/plat.html.twig', [
            'plat'=>$plt
        ]);
    }
}
