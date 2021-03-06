<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Ingredient;
use Ram\SavonBundle\Entity\Recette;
use Ram\SavonBundle\Entity\RecetteIngredient;
use Ram\SavonBundle\Entity\RecetteEtape;
use Ram\SavonBundle\Form\RecetteType;
use Ram\SavonBundle\Form\RecetteIngredientType;
use Ram\SavonBundle\Form\RecetteEtapeType;
use Ram\SavonBundle\Form\RecetteEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RecetteController extends Controller
{
	public function indexAction($page)
	{
		if ($page < 1) 
		{
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Recette');
		$listRecettes = $repository->findAll();
		return $this->render('RamSavonBundle:Recette:index.html.twig', array( 'listRecettes' => $listRecettes ));
	}

	/**
	 * @ParamConverter("recette", options={"mapping": {"recette_id": "id"}})
	 */
	public function viewAction(Recette $recette)
	{	
		$recetteIngredient = new RecetteIngredient();
		$recetteEtape = new RecetteEtape();
		$form = $this->get('form.factory')->create(new RecetteIngredientType(), $recetteIngredient);
		$formEtape = $this->get('form.factory')->create(new RecetteEtapeType(), $recetteEtape);
		return $this->render('RamSavonBundle:Recette:view.html.twig', array( 'recette' => $recette, 'form' => $form->createView(), 'formEtape' => $formEtape->createView()));
	}

	public function addAction(Request $request)
	{
		$recette = new Recette();
		$form = $this->get('form.factory')->create(new RecetteType(), $recette);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recette);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Recette bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_recette_view', array('recette_id' => $recette->getId())));
		}
		return $this->render('RamSavonBundle:Recette:add.html.twig', array('form' => $form->createView()));
	}

	public function addIngredientAction(Request $request)
	{
		$recetteIngredient = new RecetteIngredient();
		$form = $this->get('form.factory')->create(new RecetteIngredientType(), $recetteIngredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recetteIngredient);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Recette bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_recette_view', array('recette_id' => $recetteIngredient->getRecette()->getId())));
		}
		return $this->render('RamSavonBundle:Recette:add.html.twig', array('form' => $form->createView()));
	}

	public function addEtapeAction(Request $request)
	{
		$recetteEtape = new RecetteEtape();
		$form = $this->get('form.factory')->create(new RecetteEtapeType(), $recetteEtape);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recetteEtape);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Recette bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_recette_view', array('recette_id' => $recetteEtape->getRecette()->getId())));
		}
		return $this->render('RamSavonBundle:Recette:add.html.twig', array('form' => $form->createView()));
	}

	/**
	 * @ParamConverter("recette", options={"mapping": {"recette_id": "id"}})
	 */
	public function editAction(Recette $recette, Request $request)
	{
		$form = $this->get('form.factory')->create(new RecetteEditType(), $recette);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recette);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Recette bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_recette_view', array('recette_id' => $recette->getId())));
		}
		return $this->render('RamSavonBundle:Recette:edit.html.twig', array('recette' => $recette,'form' => $form->createView()));
	}

	/**
	 * @ParamConverter("recetteIngredient", options={"mapping": {"recette_id": "recette", "ingredient_id": "ingredient"}})
	 */	
	public function editIngredientAction(RecetteIngredient $recetteIngredient, Request $request)
	{
		$form = $this->get('form.factory')->create(new RecetteIngredientType(), $recetteIngredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recetteIngredient);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Recette bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_recette_view', array('recette_id' => $recetteIngredient->getRecette()->getId())));
		}
		return $this->render('RamSavonBundle:Recette:editIngredient.html.twig', array('recetteIngredient' => $recetteIngredient,'form' => $form->createView()));
	}

	/**
	 * @ParamConverter("recetteEtape", options={"mapping": {"recette_id": "recette", "etape_id": "etape"}})
	 */	
	public function editEtapeAction(RecetteEtape $recetteEtape, Request $request)
	{
		$form = $this->get('form.factory')->create(new RecetteEtapeType(), $recetteEtape);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recetteEtape);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Etape bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_recette_view', array('recette_id' => $recetteEtape->getRecette()->getId())));
		}
		return $this->render('RamSavonBundle:Recette:editEtape.html.twig', array('recetteEtape' => $recetteEtape,'form' => $form->createView()));
	}

	/**
	 * @ParamConverter("recette", options={"mapping": {"recette_id": "id"}})
	 */
	public function deleteAction(Recette $recette, Request $request)
	{
		$form = $this->createFormBuilder()->getForm();
		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($recette);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "La recette a bien été supprimée.");
			return $this->redirect($this->generateUrl('ram_recette_home'));
		}
		return $this->render('RamSavonBundle:Recette:delete.html.twig', array(
			'recette' => $recette,
			'form'    => $form->createView()
			));
	}

	/**
	 * @ParamConverter("recetteIngredient", options={"mapping": {"recette_id": "recette", "ingredient_id": "ingredient"}})
	 */	
	public function deleteIngredientAction(RecetteIngredient $recetteIngredient, Request $request)
	{
		$form = $this->createFormBuilder()->getForm();
		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($recetteIngredient);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "La recette a bien été supprimée.");
			return $this->redirect($this->generateUrl('ram_recette_view', array('recette_id' => $recetteIngredient->getRecette()->getId())));
		}
		return $this->render('RamSavonBundle:Recette:deleteIngredient.html.twig', array(
			'recetteIngredient' => $recetteIngredient,
			'form'    => $form->createView()
			));
	}

	/**
	 * @ParamConverter("recette", options={"mapping": {"recette_id": "id"}})
	 */
	public function chartsAction(Recette $recette)
	{
		$ingredients = $recette->getIngredients();

		$data = array();
		foreach ($ingredients as $ingredient) {
			$data[] = array(
				'label' => $ingredient->getIngredient()->getNom(),
				'data' => $ingredient->getQuantity()
				);
		}
		
		$response = new Response(json_encode($data));
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}

	public function menuAction($limit)
	{
		$listRecettes = array(
			array('id' => 2, 'title' => 'Savon Marseille'),
			array('id' => 5, 'title' => 'Savon Palmolive'),
			array('id' => 9, 'title' => 'Savon vaisselle')
			);
		return $this->render('RamSavonBundle:Recette:menu.html.twig', array( 'listRecettes' => $listRecettes	));
	}
}
