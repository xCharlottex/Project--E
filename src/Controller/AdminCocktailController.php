<?php

namespace App\Controller;

use App\Entity\Cocktails;
use App\Form\CocktailsType;
use App\Repository\CocktailsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminCocktailController extends AbstractController {
    /**
     * @Route("/admin/cocktail/{id}", name="admin_show_cocktail")
     */
    public function showCocktail($id, CocktailsRepository $cocktailsRepository){
        $cocktail = $cocktailsRepository->find($id);

        dump('cocktail');die;
    }

    /**
     * @Route("/admin/cocktails", name="admin_cocktails")
     */
    public function Cocktails(CocktailsRepository $cocktailsRepository){
        $cocktails = $cocktailsRepository->findAll();

    return $this->render('admin/cocktails.html.twig') ;
    }

    /**
     * @Route("/admin/cocktail/insert", name="admin_insert_cocktail")
     */
    public function insertCocktail(EntityManagerInterface $entityManager, Request $request){
        // creer une instance de la classe cocktail
        // creer un nouveau cocktail (table cocktail de ma bdd)

        $cocktail = new Cocktails();

        $form = $this->createForm(CocktailsType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($cocktail);
            $entityManager->flush();
        }
        return $this->render('admin/insert_cocktail.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/cocktail/update/{id}", name="admin_update_cocktail")
     */
    public function updateCocktail($id, CocktailsRepository $cocktailsRepository, EntityManagerInterface $entityManager, Request $request){

        $cocktail = $cocktailsRepository->find($id);

        $form = $this->createForm(CocktailsType::class, $cocktail);
        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($cocktail);
            $entityManager->flush();

            $this->addFlash('success', 'Le cocktail est modifié');
        } else {
            $this->addFlash('error', 'Le cocktail n\'est pas modifié');
        }
        return $this->render('admin/update_cocktail.html.twig');
    }

    /**
     * @Route("/admin/cocktail/delete/{id}", name="admin_delete_cocktail")
     */
    public function deleteCocktail($id, CocktailsRepository $cocktailsRepository, EntityManagerInterface $entityManager){
        $cocktail = $cocktailsRepository->find($id);

        $entityManager->remove($cocktail);
        $entityManager->flush();

        return $this->redirectToRoute('admin_cocktails');
    }
}