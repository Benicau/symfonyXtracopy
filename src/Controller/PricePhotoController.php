<?php

namespace App\Controller;

use App\Entity\PricePhoto;
use App\Form\PricePhotoType;
use App\Repository\PricePhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PricePhotoController extends AbstractController
{
    #[Route('/pricephotoIndex', name: 'pricePhotoIndex')]
    public function index(PricePhotoRepository $photos): Response
    {

        $typesPhoto = $photos -> findAll();
        return $this->render('dashboard/price_photo/index.html.twig', [
            'TypesPhotos' => $typesPhoto
        ]);
    }

    #[Route('/pricephoto/new', name: 'NewPhoto')]
    public function paperNew(EntityManagerInterface $manager, Request $request ): Response
    {
        $photo = new PricePhoto();
        $form = $this->createForm(PricePhotoType::class, $photo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($photo);
            $manager->flush();

            $this->addFlash(
                'success',
                "Nouveau prix photo a bien été créé"
            );
            return $this->redirectToRoute('pricePhotoIndex');
        }
        return $this->render('dashboard/price_photo/photoNew.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/pricephoto/{id}/delete', name: 'DeletePhoto')]
    public function paperDelete(EntityManagerInterface $manager, Request $request, PricePhoto $photo ): Response
    {
        $this->addFlash('success', "Le prix photo a bien été supprimée");
        
         $manager->remove($photo);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }


    #[Route('/pricephoto/{id}/edit', name: 'EditPhoto')]
    public function priceColorEdit(EntityManagerInterface $manager, Request $request, PricePhoto $photo ): Response
    {
        $form = $this->createForm(PricePhotoType::class, $photo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($photo);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le prix photo a bien été modifiée"
            );
            return $this->redirectToRoute('pricePhotoIndex');
        }
        return $this->render('dashboard/price_photo/photoEdit.html.twig', [
            "photo" => $photo,
            'form'=>$form->createView()]);
    }

}
