<?php

namespace Ram\SavonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieEtapeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('duree')
            ->add('ordre')
            ->add('serie', 'entity', array(
                'class'    => 'RamSavonBundle:Serie',
                'property' => 'numSerie',
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
            'data_class' => 'Ram\SavonBundle\Entity\SerieEtape'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ram_savonbundle_serieetape';
    }
}
