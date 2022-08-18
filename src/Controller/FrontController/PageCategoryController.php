<?php

namespace App\Controller\FrontController;

use App\Repository\CategoryRepository;
use App\Repository\CocktailsRepository;
use App\Repository\MocktailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageCategoryController extends AbstractController {

    /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategoryRepository $categoryRepository){
        $categories = $categoryRepository->findAll();

        return $this->render('front/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/{id}", name="show_category")
     */
    public function showCategory($id, CocktailsRepository  $cocktailRepository){

        $cocktail = $cocktailRepository->find($id);

        return $this->render('front/category.html.twig', [

            'cocktail' => $cocktail
        ]);
    }


    /**
     * @Route("/category/{id}", name="show_category_mocktail")
     */
    public function showCategoryMocktail($id, MocktailsRepository $mocktailRepository){

        $mocktail = $mocktailRepository->find($id);

        return $this->render('front/category.html.twig', [

            'cocktail' => $mocktail
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(){
        return $this->render('front/about.html.twig');
    }

}