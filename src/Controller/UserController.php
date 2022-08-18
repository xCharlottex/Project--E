<?php

namespace App\Controller;


use App\Entity\User;
use Cassandra\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController {

    /**
     * @Route("/create", name="create_user")
     */
    public function createAdmin(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager){

        // ma variable user contient une nouvelle entrée de la table user
        $user = new User();
        // definir le role Admin de cette nouvelle entrée avec le setter
        $user->setRoles(["ROLE_USER"]);

        // stock dans une variable form le modele du formulaire
        $form = $this->createForm(\App\Form\UserType::class, $user);
        // recuperer les informations qui vont etre remplies dans le formulaire
        $form->handleRequest($request);

        // condition if, est ce que le formulaire a été soumis et valide
        if ($form->isSubmitted() && $form->isValid()){
            // je recup depuis le formulaire le MDP qui a été tapé
            $plainPassword = $form->get('password')->getData();
            // je le crypte a l'aide de l'instance de classe UserPasswordHasherInterface
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            // je defini le MDP de cette nouvelle entrée avec le MDP crypté
            $user->setPassword($hashedPassword);

            // inscription dans la BDD
            // persist enregistrement
            $entityManager->persist($user);
            // flush incription BDD physiquement
            $entityManager->flush();

            $this->addFlash('sucess', 'c\'est ok');
        }
        return $this->render('front/create_user.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'Last_name' => $lastUsername,
            'error' => $error,
        ]);

    }


}