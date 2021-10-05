<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\Services\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/wish/list", name="wish_list")
     */
    public function list(WishRepository $repository) {

        $wishes = $repository->findBy([], ["dateCreated" => "DESC"], 30, 0);

        return $this->render("wish/list.html.twig", [
            "wishes" => $wishes
        ]);
    }

    /**
     * @Route("/wish/details/{id}", name="wish_details")
     */
    public function details($id, WishRepository $repository) {
        $wish = $repository->find($id);

        return $this->render("wish/details.html.twig", [
            "wish" => $wish
        ]);
    }

    /**
     * @Route("/wish/create", name="wish_create")
     */
    public function create(Request $request,
                           EntityManagerInterface $entityManager,
                            Censurator $censurator) {

        $wish = new Wish();
        $wish->setDateCreated(new \DateTime());
        $wish->setIsPublished(true);
        $wish->setAuthor($this->getUser()->getPseudo());

        $wishForm = $this->createForm(wishType::class, $wish);

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $wish->setDescription($censurator->purify($wish->getDescription()));
            $wish->setTitle($censurator->purify($wish->getTitle()));

            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Wish added to your bucket list');

            return $this->redirectToRoute('wish_details', ['id' => $wish->getId()]);
        }

        return $this->render("wish/create.html.twig", [
            'wishForm' => $wishForm->createView()
        ]);
    }

}