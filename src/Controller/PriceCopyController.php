<?php

namespace App\Controller;

use App\Form\PriceNbType;
use App\Entity\Pricecopynb;
use App\Form\PriceColorType;
use App\Entity\Pricecopycolor;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PricecopynbRepository;
use App\Repository\PricecopycolorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PriceCopyController extends AbstractController
{
    #[Route('/prixCopyIndex', name: 'prixcopieindex')]
    public function pricecopyindex(PricecopycolorRepository $color, PricecopynbRepository $nb ): Response
    {
        $pricecolor = $color->findAll();
        $pricenb = $nb->findAll();
        return $this->render('dashboard/photocopies/index.html.twig', [
            'colors' => $pricecolor,
            'nbs' => $pricenb
        ]);   
    }

    #[Route('/printCopy/color/new', name: 'priceColorNew')]
    public function printColorNew(EntityManagerInterface $manager, Request $request ): Response
    {
        $print = new Pricecopycolor();
        $form = $this->createForm(PriceColorType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre nouveau prix couleur a bien été créé"
            );
            return $this->redirectToRoute('prixcopieindex');
        }
        return $this->render('dashboard/photocopies/addcolor.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/printCopy/nb/new', name: 'priceNbNew')]
    public function printNbNew(EntityManagerInterface $manager, Request $request ): Response
    {
        $print = new Pricecopynb();
        $form = $this->createForm(PriceNbType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre nouveau prix noir et blanc a bien été créé"
            );
            return $this->redirectToRoute('prixcopieindex');
        }
        return $this->render('dashboard/photocopies/addNb.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/printCopy/nb/{id}/delete', name: 'priceNbDelete')]
    public function priceNbDelete(EntityManagerInterface $manager, Request $request, Pricecopynb $print ): Response
    {
        $this->addFlash('success', "Le prix nb a bien été supprimée");
        
         $manager->remove($print);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }

    #[Route('/printCopy/color/{id}/delete', name: 'priceColorDelete')]
    public function priceColorDelete(EntityManagerInterface $manager, Request $request, Pricecopycolor $print ): Response
    {
        $this->addFlash('success', "Le prix color a bien été supprimée");
        
         $manager->remove($print);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }

    #[Route('/printCopy/nb/{id}/edit', name: 'priceNbEdit')]
    public function priceNbEdit(EntityManagerInterface $manager, Request $request, Pricecopynb $print ): Response
    {
        $form = $this->createForm(PriceNbType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le prix a bien été modifiée"
            );
            return $this->redirectToRoute('prixcopieindex');
        }
        return $this->render('dashboard/photocopies/editNb.html.twig', [
            "print" => $print,
            'form'=>$form->createView()]);
    }

    #[Route('/printCopy/color/{id}/edit', name: 'priceColorEdit')]
    public function priceColorEdit(EntityManagerInterface $manager, Request $request, Pricecopycolor $print ): Response
    {
        $form = $this->createForm(PriceColorType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le prix a bien été modifiée"
            );
            return $this->redirectToRoute('prixcopieindex');
        }
        return $this->render('dashboard/photocopies/editColor.html.twig', [
            "print" => $print,
            'form'=>$form->createView()]);
    }



}
