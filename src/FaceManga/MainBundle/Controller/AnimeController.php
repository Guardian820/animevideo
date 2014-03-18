<?php

namespace FaceManga\MainBundle\Controller;

use FaceManga\MainBundle\Entity\Anime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
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
            
            // create the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($anime);
            $acl = $aclProvider->createAcl($objectIdentity);
            
            // retrieving the security identity of the currently logged-in user
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $securityIdentity = UserSecurityIdentity::fromAccount($user);
            
            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);
            
            return $this->redirect($this->generateUrl('facemanga_main_dashboard'));
        }
        
        return $this->render('FaceMangaMainBundle:Anime:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('FaceMangaMainBundle:Anime');
        
        $anime = $repo->findOneById($id);
        if (!$anime) {
            throw new NotFoundHttpException('Der angeforderte Anime wurde nicht gefunden!');
        }
        
        $anime->increaseViewCount();
        $this->getDoctrine()->getManager()->flush();
        
        return $this->render('FaceMangaMainBundle:Anime:show.html.twig', array(
            'anime' => $anime
        ));
    }
    
}
