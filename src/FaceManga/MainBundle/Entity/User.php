<?php
// src/Acme/UserBundle/Entity/User.php

namespace FaceManga\MainBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
}