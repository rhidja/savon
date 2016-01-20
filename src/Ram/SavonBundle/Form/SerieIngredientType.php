<?php

namespace Ram\SavonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieIngredientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serie', 'entity', array(
                'class'    => 'RamSavonBundle:Serie',
                'property' => 'numero',
            ))
            ->add('ingredient', 'entity', array(
                'class'    => 'RamSavonBundle:Ingredient',
                'property' => 'nom',
            ))
            ->add('quantity')
            ->add('unit')
            ->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ram\SavonBundle\Entity\SerieIngredient'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ram_savonbundle_serieingredient';
    }
}
