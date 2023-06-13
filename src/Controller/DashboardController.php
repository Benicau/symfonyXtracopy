<?php

namespace App\Controller;

use App\Repository\PricePhotoRepository;
use App\Repository\PriceTypePaperRepository;
use App\Repository\ReliuresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{

    #[Route('/dashboardAdmin', name: 'app_dashboardAdmin')]
    public function index(): Response
    {
        return $this->render('dashboard/indexAdmin.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboardAdmin/menuConfig', name: 'app_MenuAdmin')]
    public function indexMenu(): Response
    {
        return $this->render('dashboard/menuApi.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function indexMag(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/menu', name: 'clientNew')]
    public function newClient(): Response
    {
        return $this->render('dashboard/apiCaisse/caisse.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/index', name: 'aboIndex')]
    public function aboIndex(): Response
    {
        return $this->render('dashboard/apiCaisse/indexAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/add', name: 'aboAdd')]
    public function aboAdd(): Response
    {
        return $this->render('dashboard/apiCaisse/addAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/recherche', name: 'abosearch')]
    public function abosearch(): Response
    {
        return $this->render('dashboard/apiCaisse/rechercheAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/indexClient', name: 'indexClient')]
    public function indexClient(): Response
    {
        return $this->render('dashboard/apiCaisse/indexClient.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/noPrint', name: 'noPrint')]
    public function noPrint(ReliuresRepository $typeReliure, PriceTypePaperRepository $typePaper, PricePhotoRepository $typePhoto ): Response
    {
        $reliures = $typeReliure->findAll();
        $papers = $typePaper->findAll();
        $photos = $typePhoto->findAll();

        return $this->render('dashboard/apiCaisse/noPrint.html.twig', [
            'reliures' =>$reliures,
            'papers' =>$papers,
            'photos' =>$photos
            
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/noAbo', name: 'noAbo')]
    public function noAbo(): Response
    {
        return $this->render('dashboard/apiCaisse/noAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/withAbo', name: 'withAbo')]
    public function withAbo(): Response
    {
        return $this->render('dashboard/apiCaisse/withAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/addAbo', name: 'addAboMenu')]
    public function addAboMenu(): Response
    {
        return $this->render('dashboard/apiCaisse/addAboMenu.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }













}
