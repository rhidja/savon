<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Serie;
use Ram\SavonBundle\Form\SerieType;
use Ram\SavonBundle\Entity\SerieIngredient;
use Ram\SavonBundle\Form\SerieIngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
		return $this->render('RamSavonBundle:Serie:view.html.twig', array( 'serie' => $serie, 'form' => $form->createView() ));
	}

	public function addAction(Request $request)
	{
		$serie = new Serie();
		$form = $this->get('form.factory')->create(new SerieType(), $serie);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($serie);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Serie bien enregistrée.');
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
			$request->getSession()->getFlashBag()->add('notice', 'Serie bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serieIngredient->getSerie()->getId())));
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
			$request->getSession()->getFlashBag()->add('notice', 'Serie bien enregistrée.');
			return $this->redirect($this->generateUrl('ram_serie_view', array('serie_id' => $serie->getId())));
		}

		return $this->render('RamSavonBundle:Serie:edit.html.twig', array('serie' => $serie,'form' => $form->createView()));
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

			$request->getSession()->getFlashBag()->add('info', "La serie a bien été supprimée.");

			return $this->redirect($this->generateUrl('ram_serie_home'));
		}

		return $this->render('RamSavonBundle:Serie:delete.html.twig', array(
			'serie' => $serie,
			'form'    => $form->createView()
			));	
	}

	public function menuAction($limit)
	{
		$listSeries = array(
			array('id' => 2, 'title' => 'Savon Marseille'),
			array('id' => 5, 'title' => 'Savon Palmolive'),
			array('id' => 9, 'title' => 'Savon vaisselle')
			);

		return $this->render('RamSavonBundle:Serie:menu.html.twig', array( 'listSeries' => $listSeries	));
	}
}
