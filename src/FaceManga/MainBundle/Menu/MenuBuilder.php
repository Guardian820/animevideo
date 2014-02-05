<?php

namespace FaceManga\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    
    protected $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root', array(
            'navbar' => true
        ));
        $menu->setLabel('brand');

        $menu->addChild('dashboard.title', array('route' => 'facemanga_main_dashboard'));
        
        return $menu;
    }
    
}