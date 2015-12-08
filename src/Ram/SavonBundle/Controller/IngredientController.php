<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Ingredient;
use Ram\SavonBundle\Form\IngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

	public function viewAction($id)
	{	
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Ingredient');

		$ingredient = $repository->find($id);

		if (null === $ingredient) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

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

			return $this->redirect($this->generateUrl('ram_ingredient_view', array('id' => $ingredient->getId())));
		}

		return $this->render('RamSavonBundle:Ingredient:add.html.twig', array('form' => $form->createView()));
	}

	public function editAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Ingredient');

		$ingredient = $repository->find($id);

		if (null === $ingredient) {
			throw new NotFoundHttpException("L'ingredient d'id ".$id." n'existe pas.");
		}

		$form = $this->get('form.factory')->create(new IngredientType(), $ingredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($ingredient);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Produit bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_ingredient_view', array('id' => $ingredient->getId())));
		}

		return $this->render('RamSavonBundle:Ingredient:edit.html.twig', array('ingredient' => $ingredient,'form' => $form->createView()));
	}

	public function deleteAction($id)
	{
		return $this->render('RamSavonBundle:Ingredient:delete.html.twig');
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
