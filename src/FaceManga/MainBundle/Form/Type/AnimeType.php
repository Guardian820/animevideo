<?php

namespace FaceManga\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class AnimeType extends AbstractType
{
    
    protected $trans;
    
    public function __construct(TranslatorInterface $trans)
    {
        $this->trans = $trans;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'attr' => array('placeholder' => $this->trans->trans('create_anime.placeholder.name'))
            ))
            ->add('description', 'textarea', array(
                'attr' => array('placeholder' => $this->trans->trans('create_anime.placeholder.description'))
            ))
            ->add('year', 'number', array(
                'attr' => array(
                    'class' => 'number-spinner form-control',
                    'min' => 1,
                    'max' => 2014,
                    'placeholder' => 2000
                )
            ))
            ->add('episodes', 'number', array(
                'attr' => array(
                    'class' => 'number-spinner',
                    'min' => 0,
                    'max' => 999999,
                    'placeholder' => 0
                )
            ))
            ->add('save', 'submit', array(
                'attr' => array('class' => 'btn-primary'),
                'label' => 'create_anime.placeholder.save'
            ));
    }
    
    public function getName()
    {
        return 'anime';
    }
    
}