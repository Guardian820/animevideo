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

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $likes;

    /**
     * Add likes
     *
     * @param \FaceManga\MainBundle\Entity\Anime $likes
     * @return User
     */
    public function addLike(\FaceManga\MainBundle\Entity\Anime $likes)
    {
        $this->likes[] = $likes;

        return $this;
    }

    /**
     * Remove likes
     *
     * @param \FaceManga\MainBundle\Entity\Anime $likes
     */
    public function removeLike(\FaceManga\MainBundle\Entity\Anime $likes)
    {
        $this->likes->removeElement($likes);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLikes()
    {
        return $this->likes;
    }
}
