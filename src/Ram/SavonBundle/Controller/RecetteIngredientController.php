<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\RecetteIngredient;
use Ram\SavonBundle\Form\RecetteIngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class RecetteIngredientController extends Controller
{
	public function indexAction($page)
	{
		if ($page < 1) 
		{
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}

		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:RecetteIngredient');
		$listRecetteIngredients = $repository->findAll();
		
		return $this->render('RamSavonBundle:RecetteIngredient:index.html.twig', array( 'listRecetteIngredients' => $listRecetteIngredients ));
	}

	public function viewAction($id)
	{	
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:RecetteIngredient');

		$recetteIngredient = $repository->find($id);

		if (null === $recetteIngredient) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

		return $this->render('RamSavonBundle:RecetteIngredient:view.html.twig', array( 'recetteIngredient' => $recetteIngredient));
	}

	public function addAction(Request $request)
	{
		if (!$this->get('security.context')->isGranted('ROLE_USER')) {
			throw new AccessDeniedException('Accès limité aux auteurs.');
		}

		$recetteIngredient = new RecetteIngredient();

		$form = $this->get('form.factory')->create(new RecetteIngredientType(), $recetteIngredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recetteIngredient);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'RecetteIngredient bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_recette_ingredient_view', array('id' => $recetteIngredient->getId())));
		}

		return $this->render('RamSavonBundle:RecetteIngredient:add.html.twig', array('form' => $form->createView()));
	}

	public function editAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:RecetteIngredient');

		$recetteIngredient = $repository->find($id);

		if (null === $recetteIngredient) {
			throw new NotFoundHttpException("Le recetteIngredient d'id ".$id." n'existe pas.");
		}

		$form = $this->get('form.factory')->create(new RecetteIngredientType(), $recetteIngredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recetteIngredient);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'RecetteIngredient bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_recette_ingredient_view', array('id' => $recetteIngredient->getId())));
		}

		return $this->render('RamSavonBundle:RecetteIngredient:edit.html.twig', array('recetteIngredient' => $recetteIngredient,'form' => $form->createView()));
	}

	public function deleteAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:RecetteIngredient');

		$recetteIngredient = $repository->find($id);

		if (null === $recetteIngredient) {
			throw new NotFoundHttpException("Le recetteIngredient d'id ".$id." n'existe pas.");
		}

		$form = $this->createFormBuilder()->getForm();

		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($recetteIngredient);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "Le recetteIngredient a bien été supprimée.");

			return $this->redirect($this->generateUrl('ram_recette_ingredient_home'));
		}

		return $this->render('RamSavonBundle:RecetteIngredient:delete.html.twig', array(
			'recetteIngredient' => $recetteIngredient,
			'form'   => $form->createView()
			));	
	}


	public function menuAction($limit)
	{
		$listRecetteIngredients = array(
			array('id' => 2, 'title' => 'Savon Marseille'),
			array('id' => 5, 'title' => 'Savon Palmolive'),
			array('id' => 9, 'title' => 'Savon vaisselle')
			);

		return $this->render('RamSavonBundle:RecetteIngredient:menu.html.twig', array( 'listRecetteIngredients' => $listRecetteIngredients	));
	}
}
