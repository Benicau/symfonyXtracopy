<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypePaperController extends AbstractController
{
    #[Route('/type/paper', name: 'app_type_paper')]
    public function index(): Response
    {
        return $this->render('dashboard/type_paper/index.html.twig', [
            'controller_name' => 'TypePaperController',
        ]);
    }
}
