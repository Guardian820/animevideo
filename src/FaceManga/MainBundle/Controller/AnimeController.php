<?php

namespace FaceManga\MainBundle\Controller;

use FaceManga\MainBundle\Entity\Anime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        
        if (!$this->get('security.context')->isGranted('VIEW', $anime)) {
            throw new AccessDeniedException();
        }
        
        return $this->render('FaceMangaMainBundle:Anime:show.html.twig', array(
            'anime' => $anime
        ));
    }
    
    public function editAction($slug, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('FaceMangaMainBundle:Anime');
        
        $anime = $repo->findOneBySlug($slug);
        if (!$anime) {
            throw new NotFoundHttpException('Der angeforderte Anime wurde nicht gefunden!');
        }
        
        if (!$this->get('security.context')->isGranted('EDIT', $anime)) {
            $this->get('logger')->error(sprintf('No \'EDIT\' permission on anime with ID %d.', $anime->getId()));
            return new Response(null, Response::HTTP_FORBIDDEN);
        }
        
        $this->get('logger')->debug(sprintf('Checked for \'EDIT\' permission on anime with ID %d.', $anime->getId()));
        
        $form = $this->createForm('anime', $anime, array(
            'show_legend' => true,
            'label' => $this->get('translator')->trans('show_anime.edit')
        ));
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->redirect($this->generateUrl('facemanga_main_anime_show', array(
                'slug' => $anime->getSlug()
            )));
        }
        
        return $this->render('FaceMangaMainBundle:Anime:edit.html.twig', array(
            'form' => $form->createView()
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
        $this->get('logger')->debug(sprintf('Removed anime with ID %d', $anime->getId()));
        
        $this->get('problematic.acl_manager')->deleteAclFor($anime);
        $this->get('logger')->debug(sprintf('Removed anime\'s ACL (ID: $d)', $anime->getId()));
        
        $em->flush();
        
        return $this->redirect($this->generateUrl('facemanga_main_dashboard'));
    }
    
}
