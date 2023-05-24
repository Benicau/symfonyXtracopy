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

class PrintConfigController extends AbstractController
{

    #[Route('/dashboardAdmin/printIndex', name: 'printindex')]
    public function printindex(ImprimantesRepository $repository): Response
    {
        $imprimantes = $repository->findAll();
        return $this->render('dashboard/imprimantes/printIndex.html.twig', [
            'imprimantes' => $imprimantes
        ]);   
    }


    #[Route('/dashboardAdmin/printNew', name: 'printnew')]
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
        return $this->render('dashboard/imprimantes/printNew.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/dashboardAdmin/print/{id}/edit', name: 'printedit')]
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
        return $this->render('dashboard/imprimantes/printEdit.html.twig', [
            "print" => $print,
            'form'=>$form->createView()]);
    }

    #[Route('/dashboardAdmin/print/{id}/delete', name: 'printdelete')]
    public function printDelete(EntityManagerInterface $manager, Request $request, Imprimantes $print ): Response
    {
        $this->addFlash('success', "L'imprimante a bien été supprimée");
        
         $manager->remove($print);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }



}
