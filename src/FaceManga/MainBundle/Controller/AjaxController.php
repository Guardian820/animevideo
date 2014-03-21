<?php

namespace FaceManga\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;

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
        
        $this->setProperty($anime, $column, $value);
        
        $user = $this->get('security.context')->getToken()->getUser();
        $anime->setLastEditor($user);
        
        $this->save($anime);
        
        return new JsonResponse();
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
