<?php

namespace App\Controller;

use App\Form\PricePaperType;
use App\Entity\PriceTypePaper;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PriceTypePaperRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypePaperController extends AbstractController
{
    #[Route('/type/paper', name: 'app_type_paper')]
    public function index(PriceTypePaperRepository $papers): Response
    {
        $typePaper = $papers ->findAll();
        return $this->render('dashboard/type_paper/index.html.twig', [
            'TypesPapier' => $typePaper
        ]);
    }


    #[Route('/type/paper/new', name: 'app_type_paperNew')]
    public function paperNew(EntityManagerInterface $manager, Request $request ): Response
    {
        $print = new PriceTypePaper();
        $form = $this->createForm(PricePaperType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre nouveau type de papier a bien été créé"
            );
            return $this->redirectToRoute('app_type_paper');
        }
        return $this->render('dashboard/type_paper/paperNew.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/type/paper/{id}/delete', name: 'app_type_paperDelete')]
    public function paperDelete(EntityManagerInterface $manager, Request $request, PriceTypePaper $print ): Response
    {
        $this->addFlash('success', "Le type de papier a bien été supprimée");
        
         $manager->remove($print);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }


    #[Route('/type/paper/{id}/edit', name: 'app_type_paperEdit')]
    public function priceColorEdit(EntityManagerInterface $manager, Request $request, PriceTypePaper $print ): Response
    {
        $form = $this->createForm(PricePaperType::class, $print);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($print);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le type de papier a bien été modifiée"
            );
            return $this->redirectToRoute('app_type_paper');
        }
        return $this->render('dashboard/type_paper/paperEdit.html.twig', [
            "print" => $print,
            'form'=>$form->createView()]);
    }
}
