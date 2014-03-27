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
            // TODO: sort this by like count, but since I've currently not found a way to do so, we sort by random
            'popular_animes' => $repo->findRandom(4)
        ));
        
    }
}
