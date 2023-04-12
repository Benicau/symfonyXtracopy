<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteWebXtraCopyController extends AbstractController
{
    #[Route('/', name: 'AccueilSiteWeb')]
    public function index(): Response
    {
        return $this->render('site_web_xtra_copy/index.html.twig', [
            'controller_name' => 'SiteWebXtraCopyController',
        ]);
    }
}
