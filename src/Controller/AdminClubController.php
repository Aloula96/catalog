<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminClubController extends AbstractController
{
    #[Route('/admin/club', name: 'app_admin_club')]
    public function index(Request $request, ClubRepository $clubRepository, EntityManagerInterface $entityManager): Response
    {

        $clubs = $clubRepository->findAll();

        return $this->render('admin_club/index.html.twig', [
            // 'form' => $form->createView(),
            'clubs' => $clubs,
        ]);
    }
    #[Route('/admin/clubs/clubs_show/{id}', name: 'app_admin_club_show')]
    public function Show(
        ClubRepository $clubRepository,
        int $id,
    ): Response {


        $club = $clubRepository->find($id);
        return $this->render('admin_club/show.html.twig', [

            'club' => $club,
        ]);
    }

    #[Route('/admin/clubs_modify/{id}', name: 'app_admin_club_modify')]
    public function modify(int $id, Request $request, ClubRepository $clubRepository, EntityManagerInterface $entityManager): Response
    {


        $club = $clubRepository->find($id);


        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_club');
        }

        return $this->render('admin_club/modify.html.twig', [
            'form' => $form->createView(),
            'club' => $club,
        ]);
    }

    #[Route('/admin/club_delete/{id}', name: 'app_admin_club_delete')]
    public function delete(int $id, ClubRepository $clubRepository, EntityManagerInterface $entityManager): Response
    {



        $club = $clubRepository->find($id);


        $entityManager->remove($club);
        $entityManager->flush();


        return $this->redirectToRoute('app_admin_club');
    }
    #[Route('/admin/clubs_add', name: 'app_admin_club_add')]
    public function add( Request $request,  EntityManagerInterface $entityManager): Response
    {
       

        $club= new Club();

        $form=$this->createForm(ClubType::class,$club);
        $form->handleRequest($request);

    

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($club);
            $entityManager->flush();
         
            // return $this->redirectToRoute('app_admin_categorie');
        }

        return $this->render('admin_club/add.html.twig', [
            'form' => $form->createView(),
            'club' => $club,
        ]);
    }
    
        // $club = new Club();
        // $form = $this->createForm(ClubType::class, $club);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager->persist($club);
        //     $entityManager->flush();
        // }
}
