<?php

namespace Ram\SavonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('quantity')
            ->add('description', 'ckeditor')
            ->add('produit', 'entity', array(
                'class'    => 'RamSavonBundle:Produit',
                'property' => 'nom',
                ))
            ->add('recette', 'entity', array(
                'class'    => 'RamSavonBundle:Recette',
                'property' => 'nom',
                ))
            ->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ram\SavonBundle\Entity\Serie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ram_savonbundle_serie';
    }
}
