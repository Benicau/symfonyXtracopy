<?php

namespace App\Controller;

use App\Entity\Imprimantes;

use App\Form\ImprimanteType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ImprimantesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
            'imprimantes' => $imprimantes
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

    #[Route('/print/{id}/edit', name: 'printedit')]
    public function printEdit(EntityManagerInterface $manager, Request $request, Imprimantes $print ): Response
    {
        $form = $this->createForm(ImprimanteType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'imprimante a bien été modifiée"
            );
            return $this->redirectToRoute('printindex');
        }
        return $this->render('dashboard/printEdit.html.twig', [
            "print" => $print,
            'form'=>$form->createView()]);
    }

    #[Route('/print/{id}/delete', name: 'printdelete')]
    public function printDelete(EntityManagerInterface $manager, Request $request, Imprimantes $print ): Response
    {
        $this->addFlash('success', "L'imprimante a bien été supprimée");
        
         $manager->remove($print);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }



}
