<?php

namespace FaceManga\MainBundle\Controller;

use FaceManga\MainBundle\Entity\Anime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AnimeController extends Controller
{
    
    public function createAction(Request $request)
    {
        $anime = new Anime();
        $form = $this->createForm('anime', $anime, array(
            'show_legend' => true,
            'label' => $this->get('translator')->trans('create_anime.legend')
        ));
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($anime);
            $em->flush();
            
            return $this->redirect($this->generateUrl('facemanga_main_dashboard'));
        }
        
        return $this->render('FaceMangaMainBundle:Anime:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
}