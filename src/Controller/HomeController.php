<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function home(){
        return $this->render('home/base.html.twig');

    }

    /**
     * @Route("/about", name="about")
     */
    public function about(){
        return $this->render('front/about.html.twig');
    }
}
