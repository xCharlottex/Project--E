<?php

namespace App\Controller;

use App\Entity\Mocktails;
use App\Form\MocktailsType;
use App\Repository\CategoryRepository;
use App\Repository\MocktailsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMocktailController extends AbstractController {

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/mocktail/insert/{id}", name="admin_insert_mocktail")
     */
    public function insertMocktail(EntityManagerInterface $entityManager, Request $request, $id, CategoryRepository $categoryRepository){
        // creer une instance de la classe cocktail
        // creer un nouveau cocktail (table cocktail de ma bdd)

        $category = $categoryRepository->find($id);

        $mocktail = new Mocktails();

        $form = $this->createForm(MocktailsType::class, $mocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $mocktail->setCategory($category);
            $entityManager->persist($mocktail);
            $entityManager->flush();
            $this->addFlash('success', 'Le mocktail est créé');
            return $this->redirectToRoute('show_category', ['id' => $mocktail->getCategory()->getId()]);
        }

        return $this->render('admin/insert_update_drink.html.twig', [
            'form' => $form->createView(),
            'isCocktail' => false
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
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
            return $this->redirectToRoute('show_category', ['id' => $mocktail->getCategory()->getId()]);
        } else {
            $this->addFlash('error', 'Le mocktail n\'est pas modifié');
        }
        return $this->render('admin/insert_update_drink.html.twig', [
            'form' => $form->createView(),
            'isCocktail' => false
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route ("/admin/mocktail/delete/{id}", name="admin_delete_mocktail")
     */
    public function deleteMocktail($id, MocktailsRepository $mocktailsRepository, EntityManagerInterface $entityManager){
        $mocktail = $mocktailsRepository->find($id);
        $categoryId = $mocktail->getCategory()->getId();

        $entityManager->remove($mocktail);
        $entityManager->flush();

        $this->addFlash("success", "Le Mocktail a été supprimé");
        return $this->redirectToRoute('show_category', ['id' => $categoryId]);
    }

}