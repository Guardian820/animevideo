<?php

namespace FaceManga\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaceMangaMainBundle:Dashboard:index.html.twig');
    }
}
