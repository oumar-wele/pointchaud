<?php

namespace App\Controller;

use App\Entity\Annonce;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $repository= $this->getDoctrine()->getRepository(Annonce::class);
         $annonces=$repository->findAll();
        dump($annonces);
        $title = "Welcome Hone";
        return $this->render('page/home.html.twig', [
            'title' => $title,
            'annonces'=>$annonces,
        ]);
    }
}
