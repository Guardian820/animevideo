<?php

namespace FaceManga\MainBundle\Controller;

use FaceManga\MainBundle\Entity\Anime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

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
            
            $aclManager = $this->get('problematic.acl_manager');
            $aclManager->setObjectPermission($anime, MaskBuilder::MASK_OWNER, $this->getUser());
            
            return $this->redirect($this->generateUrl('facemanga_main_dashboard'));
        }
        
        return $this->render('FaceMangaMainBundle:Anime:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function showAction($slug)
    {
        $repo = $this->getDoctrine()->getRepository('FaceMangaMainBundle:Anime');
        
        $anime = $repo->findOneBySlug($slug);
        if (!$anime) {
            throw new NotFoundHttpException('Der angeforderte Anime wurde nicht gefunden!');
        }
        
        $anime->increaseViewCount();
        $this->getDoctrine()->getManager()->flush();
        
        return $this->render('FaceMangaMainBundle:Anime:show.html.twig', array(
            'anime' => $anime
        ));
    }
    
    public function deleteAction($id)
    {   
        $repo = $this->getDoctrine()->getRepository('FaceMangaMainBundle:Anime');
        
        $anime = $repo->findOneById($id);
        if (!$anime)
            throw new NotFoundHttpException('Der zu löschende Anime wurde nicht gefunden!');
        
        if ($this->get('security.context')->isGranted('DELETE', $anime) === false)
            throw new AccessDeniedException();
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($anime);
        $em->flush();
        
        return $this->redirect($this->generateUrl('facemanga_main_dashboard'));
    }
    
}
