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
    
    public function findRandom($count = 4)
    {
        $animes = array();
        for ($i = 1; $i <= $this->count(); $i++) {
            $id = rand(1, $this->count());
            
            $animes[] = $this->createQueryBuilder('a')
                    ->where('a.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getSingleResult();
        }
        
        return $animes;
    }
    
}