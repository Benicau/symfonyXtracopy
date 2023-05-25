<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\WorkersType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class WorkerController extends AbstractController
{
    #[Route('/worker', name: 'app_worker')]
    public function index(UserRepository $worker): Response
    {
        $workers = $worker->findAll();
        return $this->render('dashboard/worker/index.html.twig', [
            'workers' => $workers,
        ]);
    }

    #[Route('/worker/add', name: 'app_worker_add')]
    public function workerAdd(EntityManagerInterface $manager, Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(WorkersType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            

            $hash = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre nouveau employé à bien eté crée"
            );

            return $this->redirectToRoute('app_worker');
        }
        return $this->render('dashboard/worker/add.html.twig', ['form'=>$form->createView()]);
    }


    #[Route('/worker/{id}/delete', name: 'app_worker_delete')]
    public function delete(EntityManagerInterface $manager, Request $request, User $user ): Response
    {
        $this->addFlash('success', "La reliures a bien été supprimée");
        
         $manager->remove($user);
         $manager->flush();
         $referer = $request->headers->get('referer');
             return new RedirectResponse($referer);
    }


}
