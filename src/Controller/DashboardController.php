<?php

namespace App\Controller;

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

    #[Route('/dashboard/client', name: 'clientNew')]
    public function newClient(): Response
    {
        return $this->render('dashboard/caisse.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }






}
