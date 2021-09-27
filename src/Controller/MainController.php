<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of MainController
 *
 * @author bendu
 */
class MainController extends AbstractController {
    
    /**
     * @Route("/", name="main_home")
     */
    public function home() {
        return $this->render("main/home.html.twig");
    }
    
    /**
     * @Route("/test", name="main_test")
     */
    public function test() {
        return $this->render("main/test.html.twig");
    }
}
