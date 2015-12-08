<?php

namespace Ram\SavonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IngredientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom',   'text')
        ->add('type',  'text')
        ->add('unite', 'text')
        ->add('categorie')
        ->add('save',  'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ram\SavonBundle\Entity\Ingredient'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ram_savonbundle_ingredient';
    }
}
