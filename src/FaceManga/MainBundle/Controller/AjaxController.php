<?php

namespace FaceManga\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class AjaxController extends Controller
{
    public function animeAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('FaceMangaMainBundle:Anime');
        
        $column = $request->request->get('name');
        $id = $request->request->get('pk');
        $value = $request->request->get('value');
        
        $anime = $repo->findOneById($id);
        
        if (!$anime) {
            $this->returnNotFound();
        }
        
        $anime = $this->setProperty($anime, $column, $value);
        $this->save($anime);
        
        return new JsonResponse();
    }
    
    public function switchLikeAction(Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            return Response(null, Response::HTTP_FORBIDDEN);
        }
        $repo = $this->getDoctrine()->getRepository('FaceMangaMainBundle:Anime');
        
        $id = $request->query->get('id');
        
        $anime = $repo->findOneById($id);
        
        if (!$anime) {
            return ResourceNotFoundException();
        }
        
        if ($this->get('security.context')->isGranted('OWNER', $anime)) {
            return Response(null, Response::HTTP_FORBIDDEN);
        }
        
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user->getLikes()->contains($anime)) {
            $anime->removeLike($user);
            $newIcon = 'thumbs-up';
        } else {
            $anime->addLike($user);
            $newIcon = 'thumbs-down';
        }
        
        $this->getDoctrine()->getManager()->flush();
        
        return new JsonResponse(array(
            'new-icon' => $newIcon,
            'current-likes' => count($anime->getLikes())
        ));
    }
    
    protected function save($object)
    {
        $em = $this->getDoctrine()->getManager();
        $em->flush($object);
    }
    
    protected function setProperty($object, $property, $value = null)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        
        return $accessor->setValue($object, $property, $value);
    }
    
    protected function returnNotFound()
    {
        return new JsonResponse(array(
            'status' => 'error',
            'msg' => 'Element nicht gefunden!'
        ));
    }

}
