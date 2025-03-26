<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use App\Repository\LeagueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 #[Route('/shop')]
final class ShopController extends AbstractController
{
    //  #[Route('/shop_item/{id}', name: 'shop')]
    //  public function index(int $id ,ClubRepository $ClubRepository ): Response
    //  {    
    //      $club =  $ClubRepository->find($id); 
    //       dd($club);
    //     return $this->render('shop/index.html.twig', [
    //          'club' => $club,
    //     ]);
    //  }

   

    #[Route('/single/{id}', name: 'shop_single')] 
    public function single( ClubRepository $ClubRepository , int $id): Response
    {
        $club = $ClubRepository->find($id);
        // dd($club);

        return $this->render('shop/single.html.twig', [
            'club' => $club,
        ]);
    }
#[Route('', name: 'shop')]
public function index(ClubRepository $ClubRepository ): Response
{    
    $clubs =  $ClubRepository->findAll(); 
    // dd($club);
    $user = $this->getUser();
    return $this->render('shop/index.html.twig', [
        'clubs' => $clubs,
        'user' => $user, 
    ]);
}

    #[Route('/league/{id}', name: 'shop_league')] //, requirements: ['id' => '\d+'])
    public function league(int $id, ClubRepository $clubRepository): Response
    {

        $clubs = $clubRepository->findby([
            'league' => $id,
        ]);
       
        return $this->render('shop/category.html.twig', [
            'clubs' => $clubs,
        ]);
    }
}
