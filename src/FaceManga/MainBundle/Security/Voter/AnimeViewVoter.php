<?php

namespace FaceManga\MainBundle\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class AnimeViewVoter implements VoterInterface
{
 
    use Voter;
    
    public function supportsAttribute($attribute)
    {
        if ($attribute == 'VIEW') {
            return true;
        } else {
            return false;
        }
    }
    
    public function supportsClass($class)
    {
        if ($class == 'FaceManga\MainBundle\Entity\Anime') {
            return true;
        } else {
            return false;
        }
    }
    
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        if (!$this->isCompatible($object, $attributes)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }
        
        $this->logger->debug(sprintf('AnimeViewVoter: Granted VIEW on anime with ID %d.', $object->getId()));
        return VoterInterface::ACCESS_GRANTED;
    }
    
}