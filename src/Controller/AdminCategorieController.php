<?php
namespace App\Controller;

use App\Entity\League;
use App\Form\LeagueType;
use App\Repository\LeagueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategorieController extends AbstractController
{
    #[Route('/admin/leagues', name: 'app_admin_categorie')]
    public function index(  LeagueRepository $leagueRepository, ): Response
    {



        $leagues = $leagueRepository->findAll();

        return $this->render('admin_categorie/index.html.twig', [
         
            'leagues' => $leagues,
        ]);
    }
    #[Route('/admin/leagues/leagues_show/{id}', name: 'app_admin_categorie_show')]
    public function Show(Request $request,LeagueRepository $leagueRepository, int $id ,  EntityManagerInterface $entityManager): Response
    {
       

       

        $league = $leagueRepository->find($id);
        return $this->render('admin_categorie/show.html.twig', [
            
            'league' => $league,
        ]);
    }

    #[Route('/admin/leagues_modify/{id}', name: 'app_admin_categorie_modify')]
    public function modify(int $id, Request $request, LeagueRepository $leagueRepository, EntityManagerInterface $entityManager): Response
    {
       

        $league = $leagueRepository->find($id);
 

        $form = $this->createForm(LeagueType::class, $league);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($league);
            $entityManager->flush();
         
            // return $this->redirectToRoute('app_admin_categorie');
        }

        return $this->render('admin_categorie/modify.html.twig', [
            'form' => $form->createView(),
            'league' => $league,
        ]);
    }

    #[Route('/admin/leagues_delete/{id}', name: 'app_admin_categorie_delete')]
    public function delete(int $id, LeagueRepository $leagueRepository, EntityManagerInterface $entityManager): Response
    {
        
        

        $league = $leagueRepository->find($id);
    

        $entityManager->remove($league);
        $entityManager->flush();
       

        return $this->redirectToRoute('app_admin_categorie');
    }

    #[Route('/admin/leagues_add', name: 'app_admin_categorie_add')]
    public function add( Request $request,  EntityManagerInterface $entityManager): Response
    {
       

        $league= new League();

        $form=$this->createForm(LeagueType::class,$league);
        $form->handleRequest($request);

    

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($league);
            $entityManager->flush();
         
            // return $this->redirectToRoute('app_admin_categorie');
        }

        return $this->render('admin_categorie/add.html.twig', [
            'form' => $form->createView(),
            'league' => $league,
        ]);
    }
}