<?php

namespace App\Controller;

use App\Entity\Reliures;
use App\Form\ReliuresType;
use App\Repository\ReliuresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReliuresController extends AbstractController
{
    #[Route('/reliuresIndex', name: 'app_reliures')]
    public function index(ReliuresRepository $reliure): Response
    {
        $reliures = $reliure->findAll();
        return $this->render('dashboard/reliures/index.html.twig', [
            'reliures' => $reliures
        ]);
    }


    #[Route('/reliures/new', name: 'reliureNew')]
    public function printColorNew(EntityManagerInterface $manager, Request $request ): Response
    {
        $print = new Reliures();
        $form = $this->createForm(ReliuresType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre nouvelles reliure a bien été crée"
            );
            return $this->redirectToRoute('app_reliures');
        }
        return $this->render('dashboard/reliures/reliuresNew.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/reliures/{id}/delete', name: 'reliureDelete')]
    public function delete(EntityManagerInterface $manager, Request $request, Reliures $print ): Response
    {
        $this->addFlash('success', "La reliures a bien été supprimée");
        
         $manager->remove($print);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }

    #[Route('/reliures/{id}/edit', name: 'reliureEdit')]
    public function edit(EntityManagerInterface $manager, Request $request, Reliures $print ): Response
    {
        $form = $this->createForm(ReliuresType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "La reliure a bien été modifiée"
            );
            return $this->redirectToRoute('app_type_paper');
        }
        return $this->render('dashboard/reliures/reliuresEdit.html.twig', [
            "print" => $print,
            'form'=>$form->createView()]);
    }

}


