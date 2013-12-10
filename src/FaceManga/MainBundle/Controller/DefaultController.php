<?php

namespace FaceManga\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FaceMangaMainBundle:Default:index.html.twig', array('name' => $name));
    }
}
