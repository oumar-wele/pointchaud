<?php

namespace App\Controller;

use App\Entity\Annonce;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $repository= $this->getDoctrine()->getRepository(Annonce::class);
         $annonces=$repository->findBy([],['createdAt'=>'DESC']);
     
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

    /**
     * @Route("/creer-une-annonce", name="create_annoce")
     */
    public function creerAnnonce(Request $requet): Response
    {
        $form = $this->createFormBuilder(null,['action'=>'creer-une-annonce','method'=>'POST'])
                ->add('title')
                ->add('description',TextareaType::class)
                ->getForm();
                $form->handleRequest($requet);
        if($form->isSubmitted() && $form->isValid() ){
            $data= $form->getData();
            $annonce= new Annonce();

            $annonce->setTitle($data["title"])
                      ->setDescription($data["description"]);
            $em= $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();
            

            $this->addFlash('success', 'Inscription  realisé avec succes!');
            return $this->redirectToRoute("app_home");

        }
        $title = "Creer votre annonce";
         return  $this->render('page/creerAnnonce.html.twig',[
             'title'=>$title,
             'formulaire'=>$form->createView(),

         ]);

    }
        /**
     * @Route("/editer-une-annonce", name="edit_annoce")
     */
    public function etdit(): Response
    {
        $title = "Editer votre annonce";
        return $this->render('page/edit.html.twig', [
            'title' => $title,
        ]);

    }

}
