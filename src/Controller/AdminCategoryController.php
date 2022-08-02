<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController {
    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function Category(CategoryRepository $categoryRepository){
            $category = $categoryRepository->findAll();

            return $this->render('admin/category.html.twig', [
                'category' => $category
            ]);
    }

    /**
     * @Route("/admin/category/insert", name="admin_insert_category")
     */
    public function insertCategory(EntityManagerInterface $entityManager, Request $request){
        $category = new Category();

        $form = $this->createForm();
    }
}

