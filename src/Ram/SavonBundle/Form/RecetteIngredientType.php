<?php

namespace Ram\SavonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ram\SavonBundle\Entity\Ingredient;
use Ram\SavonBundle\Entity\Recette;

class RecetteIngredientType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('ingredient', 'entity', array(
			'class'    => 'RamSavonBundle:Ingredient',
			'property' => 'nom',
			))
		->add('recette', 'entity', array(
			'class'    => 'RamSavonBundle:Recette',
			'property' => 'nom',
			))
		->add('pourcentage')
		->add('save',      'submit')
		;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Ram\SavonBundle\Entity\RecetteIngredient'
			));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'ram_savonbundle_composition';
	}
}
