<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $club=new Club();
        $form=$this->createForm(ClubType::class,$club);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($club);
            $entityManager->flush();
        }
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }
}
