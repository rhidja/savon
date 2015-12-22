<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Composition;
use Ram\SavonBundle\Form\CompositionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CompositionController extends Controller
{
	public function indexAction($page)
	{
		if ($page < 1) 
		{
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}

		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Composition');

		$listCompositions = $repository->findAll();
		
		return $this->render('RamSavonBundle:Composition:index.html.twig', array( 'listCompositions' => $listCompositions ));
	}

	public function viewAction($id)
	{	
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Composition');

		$composition = $repository->find($id);

		if (null === $composition) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

		return $this->render('RamSavonBundle:Composition:view.html.twig', array( 'composition' => $composition));
	}

	public function addAction(Request $request)
	{
		if (!$this->get('security.context')->isGranted('ROLE_USER')) {
			throw new AccessDeniedException('Accès limité aux auteurs.');
		}

		$composition = new Composition();

		$form = $this->get('form.factory')->create(new CompositionType(), $composition);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($composition);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Composition bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_composition_view', array('id' => $composition->getId())));
		}

		return $this->render('RamSavonBundle:Composition:add.html.twig', array('form' => $form->createView()));
	}

	public function editAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Composition');

		$composition = $repository->find($id);

		if (null === $composition) {
			throw new NotFoundHttpException("Le composition d'id ".$id." n'existe pas.");
		}

		$form = $this->get('form.factory')->create(new CompositionType(), $composition);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($composition);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Composition bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_composition_view', array('id' => $composition->getId())));
		}

		return $this->render('RamSavonBundle:Composition:edit.html.twig', array('composition' => $composition,'form' => $form->createView()));
	}

	public function deleteAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Composition');

		$composition = $repository->find($id);

		if (null === $composition) {
			throw new NotFoundHttpException("Le composition d'id ".$id." n'existe pas.");
		}

		$form = $this->createFormBuilder()->getForm();

		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($composition);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "Le composition a bien été supprimée.");

			return $this->redirect($this->generateUrl('ram_composition_home'));
		}

		return $this->render('RamSavonBundle:Composition:delete.html.twig', array(
			'composition' => $composition,
			'form'   => $form->createView()
			));	
	}


	public function menuAction($limit)
	{
		$listCompositions = array(
			array('id' => 2, 'title' => 'Savon Marseille'),
			array('id' => 5, 'title' => 'Savon Palmolive'),
			array('id' => 9, 'title' => 'Savon vaisselle')
			);

		return $this->render('RamSavonBundle:Composition:menu.html.twig', array( 'listCompositions' => $listProduits	));
	}
}
