<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Serie;
use Ram\SavonBundle\Entity\SerieEtape;
use Ram\SavonBundle\Entity\SerieIngredient;
use Ram\SavonBundle\Form\SerieType;
use Ram\SavonBundle\Form\SerieEtapeType;
use Ram\SavonBundle\Form\SerieIngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SerieController extends Controller
{
	public function indexAction($page)
	{
		if ($page < 1) 
		{
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Serie');
		$listSeries = $repository->findAll();
		return $this->render('RamSavonBundle:Serie:index.html.twig', array( 'listSeries' => $listSeries ));
	}

	/**
 	 * @ParamConverter("serie", options={"mapping": {"serie_id": "id"}})
 	 */
	public function viewAction(Serie $serie)
	{
		$serieIngredient = new SerieIngredient();
		$form = $this->get('form.factory')->create(new SerieIngredientType(), $serieIngredient);
		$serieEtape = new SerieEtape();
		$formEtape = $this->get('form.factory')->create(new SerieEtapeType(), $serieEtape);
		return $this->render('RamSavonBundle:Serie:view.html.twig', array( 'serie' => $serie, 'form' => $form->createView(), 'formEtape' => $formEtape->createView()));
	}

	public function addAction(Request $request)
	{
		$serie = new Serie();
		$form = $this->get('form.factory')->create(new SerieType(), $serie);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			// Sauver la nouvelle recette.
			$em = $this->getDoctrine()->getManager();
			$em->persist($serie);

			// Récuperer les ingrédients de la recette.
			$ingredients = $serie->getRecette()->getIngredients();
			foreach ($ingredients as $ingredient)
			{
				$serieIngredient = new SerieIngredient();
				$serieIngredient->setSerie($serie);
				$serieIngredient->setIngredient($ingredient->getIngredient());
				
				// Calcul de la quantité.
				$quantity = ($ingredient->getQuantity() * $serie->getQuantity())/100;
				$serieIngredient->setQuantity($quantity);
				$serieIngredient->setUnite($ingredient->getUnite());
				
				$em->persist($serieIngredient);
			}

			// Récuperer les étapes de la recette.
			$etapes = $serie->getRecette()->getEtapes();
			foreach ($etapes as $etape)
			{
				$SerieEtape = new SerieEtape();
				$SerieEtape->setSerie($serie);
				$SerieEtape->setTitre($etape->getTitre());
				$SerieEtape->setOrdre($etape->getOrdre());
				$SerieEtape->setDuree($etape->getDuree());
				$SerieEtape->setDescription($etape->getDescription());
				$em->persist($SerieEtape);
			}

			// Enrigistrer.
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', 'Série ajoutée.');
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serie->getId())));
		}

		return $this->render('RamSavonBundle:Serie:add.html.twig', array('form' => $form->createView()));
	}

	public function addIngredientAction(Request $request)
	{
		$serieIngredient = new SerieIngredient();
		$form = $this->get('form.factory')->create(new SerieIngredientType(), $serieIngredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($serieIngredient);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Ingrédient ajouté.");
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serieIngredient->getSerie()->getId())));
		}
		return $this->render('RamSavonBundle:Serie:addIngredient.html.twig', array('form' => $form->createView()));
	}

	public function addEtapeAction(Request $request)
	{
		$serieEtape = new SerieEtape();
		$form = $this->get('form.factory')->create(new SerieEtapeType(), $serieEtape);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($serieEtape);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Serie bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serieEtape->getSerie()->getId())));
		}
		return $this->render('RamSavonBundle:Serie:add.html.twig', array('form' => $form->createView()));
	}
	
	/**
 	 * @ParamConverter("serie", options={"mapping": {"serie_id": "id"}})
 	 */
	public function editAction(Serie $serie, Request $request)
	{
		$form = $this->get('form.factory')->create(new SerieType(), $serie);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($serie);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', 'Série modifiée.');
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serie->getId())));
		}

		return $this->render('RamSavonBundle:Serie:edit.html.twig', array('serie' => $serie,'form' => $form->createView()));
	}

	/**
	 * @ParamConverter("serieIngredient", options={"mapping": {"serie_id": "serie", "ingredient_id": "ingredient"}})
	 */	
	public function editIngredientAction(SerieIngredient $serieIngredient, Request $request)
	{
		$form = $this->get('form.factory')->create(new SerieIngredientType(), $serieIngredient);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($serieIngredient);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', 'Ingrédient modifié.');
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serieIngredient->getSerie()->getId())));
		}
		return $this->render('RamSavonBundle:Serie:editIngredient.html.twig', array('serieIngredient' => $serieIngredient,'form' => $form->createView()));
	}
	
	/**
 	 * @ParamConverter("serie", options={"mapping": {"serie_id": "id"}})
 	 */
	public function deleteAction(Serie $serie, Request $request)
	{
		$form = $this->createFormBuilder()->getForm();
		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($serie);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Série supprimée.");
			return $this->redirect($this->generateUrl('ram_serie_home'));
		}
		return $this->render('RamSavonBundle:Serie:delete.html.twig', array(
			'serie' => $serie,
			'form'    => $form->createView()
			));	
	}

	/**
	 * @ParamConverter("serieIngredient", options={"mapping": {"serie_id": "serie", "ingredient_id": "ingredient"}})
	 */	
	public function deleteIngredientAction(SerieIngredient $serieIngredient, Request $request)
	{
		$form = $this->createFormBuilder()->getForm();
		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($serieIngredient);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Ingrédient supprimé.");
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serieIngredient->getSerie()->getId())));
		}
		return $this->render('RamSavonBundle:Serie:deleteIngredient.html.twig', array(
			'serieIngredient' => $serieIngredient,
			'form'    => $form->createView()
			));
	}

	/**
	 * @ParamConverter("serie", options={"mapping": {"serie_id": "id"}})
	 */
	public function chartsAction(Serie $serie)
	{
		$ingredients = $serie->getIngredients();

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
}
