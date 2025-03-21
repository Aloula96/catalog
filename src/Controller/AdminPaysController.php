<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminPaysController extends AbstractController
{
    #[Route('/admin/pays', name: 'app_admin_pays')]
    public function index(  CountryRepository $countryRepository,  ): Response
    {   $countrys = $countryRepository->findAll();

        return $this->render('admin_pays/index.html.twig', [
            'countrys' => $countrys,
        ]);
    }
    #[Route('/admin/countrys/countrys_show/{id}', name: 'app_admin_country_show')]
    public function Show(Request $request,CountryRepository $countryRepository, int $id ): Response
    {
       

       

        $country = $countryRepository->find($id);
        return $this->render('admin_pays/show.html.twig', [
            
            'country' => $country,
        ]);
    }
    #[Route('/admin/countrys_modify/{id}', name: 'app_admin_country_modify')]
    public function modify(int $id, Request $request, CountryRepository $countryRepository, EntityManagerInterface $entityManager): Response
    {
       

        $country = $countryRepository->find($id);
 

        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($country);
            $entityManager->flush();
         
            // return $this->redirectToRoute('app_admin_categorie');
        }

        return $this->render('admin_pays/modify.html.twig', [
            'form' => $form->createView(),
            'country' => $country,
        ]);
    }

    #[Route('/admin/countrys_delete/{id}', name: 'app_admin_country_delete')]
    public function delete(int $id, CountryRepository $countryRepository, EntityManagerInterface $entityManager): Response
    {
        
        

        $country = $countryRepository->find($id);
    

        $entityManager->remove($country);
        $entityManager->flush();
       

        return $this->redirectToRoute('app_admin_pays');
    }
    #[Route('/admin/countrys_add', name: 'app_admin_country_add')]
    public function add( Request $request,  EntityManagerInterface $entityManager): Response
    {
       

        $country= new Country();

        $form=$this->createForm(CountryType::class,$country);
        $form->handleRequest($request);

    

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($country);
            $entityManager->flush();
         
            // return $this->redirectToRoute('app_admin_categorie');
        }

        return $this->render('admin_pays/add.html.twig', [
            'form' => $form->createView(),
            'country' => $country,
        ]);
    }
}

