<?php

namespace Ram\SavonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Ram\SavonBundle\Form\RecetteType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecetteEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        # TO DO
    }

    
    /**
     * @return string
     */
    public function getName()
    {
        return 'ram_savonbundle_recette_edit';
    }

    public function getParent()
    {
        return new RecetteType();
    }
}
