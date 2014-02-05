<?php

namespace FaceManga\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnimeController extends Controller
{
    
    public function createAction()
    {
        return $this->render('FaceMangaMainBundle:Anime:create.html.twig');
    }
    
}
