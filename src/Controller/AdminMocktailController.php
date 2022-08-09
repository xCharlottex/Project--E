<?php

namespace App\Controller;

use App\Entity\Mocktails;
use App\Form\MocktailsType;
use App\Repository\MocktailsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMocktailController extends AbstractController {

    /**
     * @Route("/admin/mocktail/{id}", name="admin_show_mocktail")
     */
    public function showMocktail($id, MocktailsRepository $mocktailsRepository){
        $mocktail = $mocktailsRepository->find($id);

        return $this->render('admin/mocktail.html.twig', [
            'mocktail' => $mocktail
            ]);
    }

    /**
     * @Route("/admin/mocktails", name="admin_mocktails")
     */
    public function Mocktails(MocktailsRepository $mocktailsRepository){
        $mocktails = $mocktailsRepository->findAll();

    return $this->render('admin/mocktails.html.twig', [
        'mocktails' => $mocktails
    ]);
    }


    /**
     * @Route("/admin/mocktail/insert", name="admin_insert_mocktail")
     */
    public function insertMocktail(EntityManagerInterface $entityManager, Request $request){
        // creer une instance de la classe cocktail
        // creer un nouveau cocktail (table cocktail de ma bdd)

        $mocktail = new Mocktails();

        $form = $this->createForm(MocktailsType::class, $mocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($mocktail);
            $entityManager->flush();
        }

        return $this->render('admin/insert_mocktail.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/mocktail/update/{id}", name="admin_update_mocktail")
     */
    public function updateMocktail($id, MocktailsRepository $mocktailsRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $mocktail = $mocktailsRepository->find($id);

        $form = $this->createForm(MocktailsType::class, $mocktail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($mocktail);
            $entityManager->flush();

            $this->addFlash('success', 'Le mocktail est modifié');
        } else {
            $this->addFlash('error', 'Le mocktail n\'est pas modifié');
        }
        return $this->render('admin/update_mocktail.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/mocktail/delete/{id}", name="admin_delete_mocktail")
     */
    public function deleteMocktail($id, MocktailsRepository $mocktailsRepository, EntityManagerInterface $entityManager){
        $mocktail = $mocktailsRepository->find($id);

        $entityManager->remove($mocktail);
        $entityManager->flush();

        // admin_mocktails
        return $this->redirectToRoute('admin_mocktails');
    }

}