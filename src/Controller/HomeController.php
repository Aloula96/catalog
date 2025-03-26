<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index(ClubRepository $clubRepository): Response
    {
        $clubs = $clubRepository->findAll();
        // dd($clubs);
        return $this->render('home/index.html.twig', [
            'clubs' => $clubs,
        ]);
    }
    
}

