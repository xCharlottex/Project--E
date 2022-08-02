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

        return $this->render('admin/cocktail.html.twig', [
            'cocktail' => $cocktail
        ]);
    }

    /**
     * @Route("/admin/cocktails", name="admin_cocktails")
     */
    public function Cocktails(CocktailsRepository $cocktailsRepository){
        $cocktails = $cocktailsRepository->findAll();

    return $this->render('admin/cocktails.html.twig', [
        'cocktails'=> $cocktails
    ]);
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

        // utiliser la ligne de commande php bin/console make:form
        // symfony me créer une classe qui contient le plan du formulaire , c'est la classe CocktailType
        // j'utilise la methode $this->>createForm pour creer un formulaire en utilisant le plan du formulaire
        // CocktailType et une instance de cocktail

        $form = $this->createForm(CocktailsType::class, $cocktail);

        // on donne a la variable qui contient le formulaire une instance de classe Request
        // pour que le formulaire puisse recuperer toutes les donnees
        // des inputs et faire les setters sur $cocktail
        $form-> handleRequest($request);

        // si le formulaire a été posté et que les données sont valides (valeurs des inputs correspondent
        // a ce qui est attendu en bd pour la table cocktail
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($cocktail);
            $entityManager->flush();

            $this->addFlash('success', 'Le cocktail est modifié');
        } else {
            $this->addFlash('error', 'Le cocktail n\'est pas modifié');
        }
        return $this->render('admin/update_cocktail.html.twig', [
            'form' => $form->createView(),
            'cocktail' => $cocktail
        ]);
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