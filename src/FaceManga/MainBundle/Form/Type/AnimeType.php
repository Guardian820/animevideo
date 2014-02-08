<?php

namespace FaceManga\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AnimeType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', 'textarea')
            ->add('year', 'number')
            ->add('episodes', 'number')
            ->add('save', 'submit', array(
                'attr' => array('class' => 'btn-primary'),
                'label' => 'create_anime.save'
            ));
    }
    
    public function getName()
    {
        return 'anime';
    }
    
}