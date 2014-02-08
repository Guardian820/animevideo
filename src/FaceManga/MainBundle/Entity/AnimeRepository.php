<?php

namespace FaceManga\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AnimeRepository extends EntityRepository
{
    
    public function count()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('count(a.id)');
        
        return $qb->getQuery()->getSingleScalarResult();
    }
    
}