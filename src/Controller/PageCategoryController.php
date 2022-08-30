<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\CocktailsRepository;
use App\Repository\MocktailsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function showCategory($id, CategoryRepository  $categoryRepository, CocktailsRepository  $cocktailRepository, MocktailsRepository $mocktailsRepository){
        $category = $categoryRepository->find($id);
        if($category->isIsCocktailCategory()){
            $drinks = $cocktailRepository->findBy(['category' => $category]);
        } else {
            $drinks = $mocktailsRepository->findBy(['category' => $category]);
        }


        return $this->render('front/category.html.twig', [
            'drinks' => $drinks,
            'category' => $category
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/category/insert", name="admin_insert_category")
     */
    public function insertCategory(EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger){
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->get('image')->getData() && $form->get('backgroundImage')->getData() ) {

            // je récupère l'image dans le formulaire (l'image est en mapped false donc c'est à moi
            // de gérer l'upload
            $image = $form->get('image')->getData();
            $backgroundImage = $form->get('backgroundImage')->getData();

            $newFilename = $this->handleImage($slugger, $image, "miniature");
            $newFilenameBackground = $this->handleImage($slugger, $backgroundImage, "background");

            $category->setImage($newFilename);
            $category->setBackgroundImage($newFilenameBackground);
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('categories');
        }

        return $this->render('admin/insert_update_category.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/category/update/{id}", name="admin_update_category")
     */
    public function updateCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger){

        $category = $categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // je récupère l'image dans le formulaire (l'image est en mapped false donc c'est à moi
            // de gérer l'upload
            $image = $form->get('image')->getData();
            $backgroundImage = $form->get('backgroundImage')->getData();

            if($image) {
                $newFilename = $this->handleImage($slugger, $image, "miniature");
                $category->setImage($newFilename);
            }

            if($backgroundImage) {
                $newFilename = $this->handleImage($slugger, $backgroundImage, "background");
                $category->setBackgroundImage($newFilename);
            }

            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'La catégorie est modifié');
            return $this->redirectToRoute('categories');
        } else {
            $this->addFlash('error', 'La catégorie n\'est pas modifié');
        }
        return $this->render('admin/insert_update_category.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/category/delete/{id}", name="admin_delete_category")
     */
    public function deleteCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager){
        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        $this->addFlash("success", "La catégorie a bien été supprimée");
        return $this->redirectToRoute('categories');
    }


    private function handleImage($slugger, $image, $prefix = ""): string {
        // je récupère le nom du fichier original
        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

        // j'utilise une instance de la classe Slugger et sa méthode slug pour
        // supprimer les caractères spéciaux, espaces etc du nom du fichier
        $safeFilename = $slugger->slug($originalFilename);
        // je rajoute au nom de l'image, un identifiant unique (au cas ou
        // l'image soit uploadée plusieurs fois)
        $newFilename = $prefix . "-" . $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

        // je déplace l'image dans le dossier public et je la renomme avec le nouveau nom créé
        $image->move(
            $this->getParameter('files'),
            $newFilename
        );

        return $newFilename;
    }

}