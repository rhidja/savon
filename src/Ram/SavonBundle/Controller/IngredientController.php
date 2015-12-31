<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Ingredient;
use Ram\SavonBundle\Form\IngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class IngredientController extends Controller
{
	public function indexAction($page)
	{
		if ($page < 1) 
		{
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}

		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Ingredient');

		$listIngredients = $repository->findAll();

		return $this->render('RamSavonBundle:Ingredient:index.html.twig', array( 'listIngredients' => $listIngredients ));
	}

	/**
 	 * @ParamConverter("ingredient", options={"mapping": {"ingredient_id": "id"}})
 	 */
	public function viewAction(Ingredient $ingredient)
	{	
		return $this->render('RamSavonBundle:Ingredient:view.html.twig', array( 'ingredient' => $ingredient ));
	}

	public function addAction(Request $request)
	{
		
		$ingredient = new Ingredient();

		$form = $this->get('form.factory')->create(new IngredientType(), $ingredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($ingredient);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Ingredient bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_ingredient_view', array('ingredient_id' => $ingredient->getId())));
		}

		return $this->render('RamSavonBundle:Ingredient:add.html.twig', array('form' => $form->createView()));
	}

	/**
 	 * @ParamConverter("ingredient", options={"mapping": {"ingredient_id": "id"}})
 	 */
	public function editAction(Ingredient $ingredient, Request $request)
	{
		$form = $this->get('form.factory')->create(new IngredientType(), $ingredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($ingredient);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Ingredient bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_ingredient_view', array('ingredient_id' => $ingredient->getId())));
		}

		return $this->render('RamSavonBundle:Ingredient:edit.html.twig', array('ingredient' => $ingredient,'form' => $form->createView()));
	}

	/**
 	 * @ParamConverter("ingredient", options={"mapping": {"ingredient_id": "id"}})
 	 */
	public function deleteAction(Ingredient $ingredient, Request $request)
	{
		$form = $this->createFormBuilder()->getForm();

		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($ingredient);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "L'ingredient a bien été supprimée.");

			return $this->redirect($this->generateUrl('ram_ingredient_home'));
		}

		return $this->render('RamSavonBundle:Ingredient:delete.html.twig', array(
			'ingredient' => $ingredient,
			'form'   => $form->createView()
			));	
	}


	public function menuAction($limit)
	{
		$listIngredients = array(
			array('id' => 2, 'title' => 'Savon Marseille'),
			array('id' => 5, 'title' => 'Savon Palmolive'),
			array('id' => 9, 'title' => 'Savon vaisselle')
			);

		return $this->render('RamSavonBundle:Ingredient:menu.html.twig', array( 'listIngredients' => $listIngredients	));
	}
}
