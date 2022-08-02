<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController {
    /**
     * @Route("/admin/categories", name="admin_categories")
     */
    public function categories(CategoryRepository $categoryRepository){
            $categories = $categoryRepository->findAll();

            return $this->render('admin/categories.html.twig', [
                'categories' => $categories
            ]);
    }

    /**
     * @Route("/admin/category/{id}", name="admin_show_category")
     */
    public function showCategory($id, CategoryRepository $categoryRepository){
        $category = $categoryRepository->find($id);

        return $this->render('admin/category.html.twig', [
            'category' => $category
        ]);
    }

    /**
     * @Route("/admin/category/insert", name="admin_insert_category")
     */
    public function insertCategory(EntityManagerInterface $entityManager, Request $request){
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->render('admin/insert_category.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/category/update/{id}", name="admin_update_category")
     */
    public function updateCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager, Request $request){
        $category = $categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'La catégorie est modifié');
        } else {
            $this->addFlash('error', 'La catégorie n\'est pas modifié');
        }
        return $this->render('admin\update_category.html.twig',[
            'form' => $form->createView(),
            'category' => $category
        ]);
    }

    /**
     * @Route("/admin/category/delete/{id}", name="admin_delete_category")
     */
    public function deleteCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager){
        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('admin_category');
    }
}

