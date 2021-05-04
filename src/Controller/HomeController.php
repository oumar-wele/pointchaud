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
     
        $title = "Welcome Hone";
        return $this->render('page/home.html.twig', [
            'title' => $title,
            'annonces'=>$annonces,
        ]);
    }
    /**
     * @Route("/annonces/{id<[0-9]+>}", name="annonce_show")
     */
    public function show(Annonce $annonce): Response
    {
        
        
        $title = "show";
        return $this->render('page/show.html.twig', [
            'title' => $title,
            'annonce'=>$annonce,
        ]);
    }

}
