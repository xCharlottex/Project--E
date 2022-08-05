<?php

namespace App\Controller\FrontController;

use App\Repository\CocktailsRepository;
use App\Repository\MocktailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageMocktailController extends AbstractController {

    /**
     * @Route("/home", name="home")
     */
    public function home(){
        return $this->render('home.html.twig');

    }

    /**
     * @Route("mocktail/{id}", name="show_mocktail")
     */
    public function showMocktail($id, MocktailsRepository $mocktailsRepository){
        $cocktail = $mocktailsRepository->find($id);

        return $this->render('front/mocktail.html.twig', [
            'mocktail' => $mocktail
        ]);
    }

    /**
     * @Route("/mocktails", name="mocktails")
     */
    public function Mocktails(MocktailsRepository $mocktailsRepository){
        $mocktails = $mocktailsRepository->findAll();

        return $this->render('front/mocktails.html.twig', [
            'mocktails'=> $mocktails
        ]);
    }

}