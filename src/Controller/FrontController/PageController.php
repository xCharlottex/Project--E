<?php

namespace App\Controller\FrontController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController {
    /**
     * @Route("/home", name="home")
     */
    public function home(){
        dump('coucou');die;
    }

}