<?php

namespace Ram\SavonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Ram\SavonBundle\Entity\Produit;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecetteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom')
        ->add('dureeSponification')
        ->add('dureeCure')
        ->add('description')
        ->add('produit', 'entity', array(
            'class'    => 'RamSavonBundle:Produit',
            'property' => 'nom',
            ))
        ->add('save',      'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ram\SavonBundle\Entity\Recette'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ram_savonbundle_recette';
    }
}
