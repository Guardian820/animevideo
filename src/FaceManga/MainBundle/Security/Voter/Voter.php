<?php

namespace FaceManga\MainBundle\Security\Voter;

use Psr\Log\LoggerInterface;

trait Voter
{
    
    protected $logger;
    
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    protected function isCompatible($object, array $attributes) {
        if (count($attributes) === 1 and $this->supportsAttribute($attributes[0])) {
            if ($this->supportsClass(get_class($object))) {
                return true;
            }
        }
        
        return false;
    }
}