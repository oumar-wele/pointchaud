<?php

namespace App\Controller;

use App\Entity\Annonce;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\AnnonceType;

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
        $annonce= new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);


        $form->handleRequest($requet);

        if($form->isSubmitted() && $form->isValid() ){
            $data= $form->getData();
            

            $annonce->setTitle($data["title"])
                      ->setDescription($data["description"]);
            $em= $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();
            

            $this->addFlash('success', 'Votre annonce à été creer avec succes!');
            return $this->redirectToRoute("app_home");

        }
        $title = "Creer votre annonce";
         return  $this->render('page/creerAnnonce.html.twig',[
             'title'=>$title,
             //'annonce'=>$annonce,
             'formulaire'=>$form->createView(),

         ]);

    }
    /**
     * @Route("/annonces/{id<[0-9]+>}/modifier", name="edit_annoce")
     */
    public function etdit(Annonce $annonce,Request $requet): Response
    {
        $form = $this->createForm(AnnonceType::class, $annonce);

        $form->handleRequest($requet);

        if($form->isSubmitted() && $form->isValid() ){


            $em= $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Votre annonce à été modifier avec succes!');
            

            return $this->redirectToRoute("app_home");

        }

        $title = "Editer votre annonce";
        return $this->render('page/edit.html.twig', [
            'title' => $title,
            'formulaire'=>$form->createView(),
        ]);

    }
    /**
     * @Route("/annonces/{id<[0-9]+>}/supprimer", name="delate_annoce", methods={"DELATE"})
     */
    public function delete(Request $requet,Annonce $annonce): Response
    {
        if($this->isCsrfTokenValid('delation.annoce',$requet->request->get('csrf_token'))){
            $em= $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush();

            $this->addFlash('info', 'Votre annonce à été Suppromer!');

        }


        return $this->redirectToRoute("app_home");

    }

}
