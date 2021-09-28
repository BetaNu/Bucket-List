<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/wish/list", name="wish_list")
     */
    public function list() {
        return $this->render("wish/list.html.twig");
    }

    /**
     * @Route("/wish/details/{id}", name="wish_details")
     */
    public function details($id) {
        return $this->render("wish/list.html.twig");
    }

}