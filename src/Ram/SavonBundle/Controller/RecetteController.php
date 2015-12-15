<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Recette;
use Ram\SavonBundle\Form\RecetteType;
use Ram\SavonBundle\Form\RecetteEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

	public function viewAction($id)
	{	
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Recette');

		$recette = $repository->find($id);

		if (null === $recette) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

		return $this->render('RamSavonBundle:Recette:view.html.twig', array( 'recette' => $recette));
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

			return $this->redirect($this->generateUrl('ram_recette_view', array('id' => $recette->getId())));
		}

		return $this->render('RamSavonBundle:Recette:add.html.twig', array('form' => $form->createView()));
	}

	public function editAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Recette');

		$recette = $repository->find($id);

		if (null === $recette) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

		$form = $this->get('form.factory')->create(new RecetteEditType(), $recette);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($recette);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Recette bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_recette_view', array('id' => $recette->getId())));
		}

		return $this->render('RamSavonBundle:Recette:edit.html.twig', array('recette' => $recette,'form' => $form->createView()));
	}

	public function deleteAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Recette');

		$recette = $repository->find($id);

		if (null === $recette) {
			throw new NotFoundHttpException("La recette d'id ".$id." n'existe pas.");
		}

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
