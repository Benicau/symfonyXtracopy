<?php

namespace App\Controller;

use App\Entity\Abonne;
use App\Form\AbonneEdit;
use App\Form\AbonneType;
use App\Form\SearchAbonneType;
use App\Repository\AbonneRepository;
use App\Repository\ReliuresRepository;
use App\Repository\PricePhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\PriceTypePaperRepository;
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

    #[Route('/dashboardAdmin/menuConfig', name: 'app_MenuAdmin')]
    public function indexMenu(): Response
    {
        return $this->render('dashboard/menuApi.html.twig', [
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

    #[Route('/dashboard/apiCaisse/menu', name: 'clientNew')]
    public function newClient(): Response
    {
        return $this->render('dashboard/apiCaisse/caisse.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/index', name: 'aboIndex')]
    public function aboIndex(): Response
    {
        return $this->render('dashboard/apiCaisse/indexAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/add', name: 'aboAdd')]
    public function aboAdd(EntityManagerInterface $manager, Request $request): Response
    {
        $abo = new Abonne(); 
        $form = $this->createForm(AbonneType::class, $abo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($abo);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre nouveau abonné a bien été créé"
            );
            return $this->redirectToRoute('aboIndex');
        }
        return $this->render('dashboard/apiCaisse/addAbo.html.twig', ['form'=>$form->createView()]);
    }


    #[Route('/dashboard/apiCaisse/abo/recherche', name: 'abosearch')]
    public function abosearch(Request $request, AbonneRepository $abonneRepository, PaginatorInterface $paginator): Response
    {
        $form = $this->createForm(SearchAbonneType::class);
        $form->handleRequest($request);

        $queryBuilder = $abonneRepository->createQueryBuilder('a');
        $queryBuilder->orderBy('a.Nom', 'ASC'); // Classement par ordre alphabétique sur le nom

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $nom = $data['nom'] ?? '';
            $prenom = $data['prenom'] ?? '';

            $queryBuilder
                ->where('a.Nom LIKE :nom')
                ->andWhere('a.Surname LIKE :prenom')
                ->setParameter('nom', '%' . $nom . '%')
                ->setParameter('prenom', '%' . $prenom . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            5 // Nombre de résultats par page
        );

        return $this->render('dashboard/apiCaisse/rechercheAbo.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/{id}/edit', name: 'EditAbo')]
    public function aboEdit(EntityManagerInterface $manager, Request $request, Abonne $abo): Response
    {

        $form = $this->createForm(AbonneEdit::class, $abo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($abo);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'abonné a bien été modifiée"
            );
            return $this->redirectToRoute('abosearch');
        }
        return $this->render('dashboard/apiCaisse/editAbo.html.twig', [
            "abo" => $abo,
            'form'=>$form->createView()  
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/{id}/delete', name: 'DeleteAbo')]
    public function deleteAbo(EntityManagerInterface $manager, Request $request, Abonne $abo ): Response
    {
        $this->addFlash('success', "L'abonné a bien été supprimé");
        
         $manager->remove($abo);
         $manager->flush();
         return $this->redirectToRoute('abosearch');
    }


    #[Route('/dashboard/apiCaisse/abo/indexClient', name: 'indexClient')]
    public function indexClient(): Response
    {
        return $this->render('dashboard/apiCaisse/indexClient.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/noPrint', name: 'noPrint')]
    public function noPrint(ReliuresRepository $typeReliure, PriceTypePaperRepository $typePaper, PricePhotoRepository $typePhoto ): Response
    {
        $reliures = $typeReliure->findAll();
        $papers = $typePaper->findAll();
        $photos = $typePhoto->findAll();

        return $this->render('dashboard/apiCaisse/noPrint.html.twig', [
            'reliures' =>$reliures,
            'papers' =>$papers,
            'photos' =>$photos
            
        ]);
    }

    

    #[Route('/dashboard/apiCaisse/abo/noAbo', name: 'noAbo')]
    public function noAbo(): Response
    {
        return $this->render('dashboard/apiCaisse/noAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/withAbo', name: 'withAbo')]
    public function withAbo(): Response
    {
        return $this->render('dashboard/apiCaisse/withAbo.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/dashboard/apiCaisse/abo/addAbo', name: 'addAboMenu')]
    public function addAboMenu(EntityManagerInterface $manager, Request $request): Response
    {

        $abo = new Abonne(); 
        $form = $this->createForm(AbonneType::class, $abo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($abo);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre nouveau abonné a bien été créé"
            );
            return $this->redirectToRoute('indexClient');
        }
        return $this->render('dashboard/apiCaisse/addAboMenu.html.twig', ['form'=>$form->createView()]);
    }













}
