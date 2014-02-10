<?php

namespace FaceManga\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('FaceMangaMainBundle:Anime');
        
        return $this->render('FaceMangaMainBundle:Dashboard:index.html.twig', array(
            'anime_count' => $repo->count(),
            'random_animes' => $repo->findRandom()
        ));
        
    }
}
