<?php

namespace FaceManga\MainBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class ArrayToStringTransformer implements DataTransformerInterface
{
    
    protected $glue;
    
    public function __construct($glue = ',')
    {
        $this->glue = $glue;
    }
    
    public function transform($array)
    {
        return (is_array($array)) ? implode($this->glue, $array) : null;
    }
    
    public function reverseTransform($string)
    {
        return explode($this->glue, $string);
    }
    
}