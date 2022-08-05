<?php

namespace App\Controller\FrontController;

use App\Repository\CocktailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageCocktailController extends AbstractController {
    /**
     * @Route("/home", name="home")
     */
    public function home(){
        return $this->render('home.html.twig');
    }

    /**
     * @Route("cocktail/{id}", name="show_cocktail")
     */
    public function showCocktail($id, CocktailsRepository $cocktailsRepository){
        $cocktail = $cocktailsRepository->find($id);

        return $this->render('front/cocktail.html.twig', [
            'cocktail' => $cocktail
        ]);
    }


    /**
     * @Route("/cocktails", name="cocktails")
     */
    public function Cocktails(CocktailsRepository $cocktailsRepository){
        $cocktails = $cocktailsRepository->findAll();

        return $this->render('front/cocktails.html.twig', [
            'cocktails'=> $cocktails
        ]);
    }

}