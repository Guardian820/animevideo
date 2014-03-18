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
    
    public function findPopular($limit, $offset = 0)
    {
        $qb = $this->createQueryBuilder('a')
                ->orderBy('a.view_count', 'DESC')
                ->setFirstResult($offset)
                ->setMaxResults($limit);
        
        return $qb->getQuery()->getResult();
    }
    
    public function findRandom($count = 4)
    {
        $countRows = $this->count();
        $animes = array();
        
        for ($i = 1; $i <= $count; $i++) {
            $id = rand(1, $countRows);
            
            $animes[] = $this->createQueryBuilder('a')
                    ->where('a.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getSingleResult();
        }
        
        return $animes;
    }
    
}