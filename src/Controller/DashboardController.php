<?php

namespace App\Controller;

use App\Entity\Imprimantes;
use App\Form\ImprimanteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ImprimantesRepository;

class DashboardController extends AbstractController
{
    #[Route('/dashboardAdmin', name: 'app_dashboardAdmin')]
    public function index(): Response
    {
        return $this->render('dashboard/indexAdmin.html.twig', [
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

    #[Route('/client', name: 'clientNew')]
    public function newClient(): Response
    {
        return $this->render('dashboard/caisse.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/printIndex', name: 'printindex')]
    public function printindex(ImprimantesRepository $repository): Response
    {
        $imprimantes = $repository->findAll();
        return $this->render('dashboard/printIndex.html.twig', [
            'imprimantes' => $imprimantes,
        ]);   
    }

    #[Route('/printNew', name: 'printnew')]
    public function printNew(EntityManagerInterface $manager, Request $request ): Response
    {
        $print = new Imprimantes();
        $form = $this->createForm(ImprimanteType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre imprimante a bien été créé"
            );
            return $this->redirectToRoute('printindex');
        }









        return $this->render('dashboard/printNew.html.twig', ['form'=>$form->createView()]);
    }



}
