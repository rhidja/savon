<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Produit;
use Ram\SavonBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProduitController extends Controller
{
	public function indexAction($page)
	{
		if ($page < 1) 
		{
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}

		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Produit');

		$listProduits = $repository->findAll();
		
		return $this->render('RamSavonBundle:Produit:index.html.twig', array( 'listProduits' => $listProduits ));
	}

	/**
 	 * @ParamConverter("produit", options={"mapping": {"produit_id": "id"}})
 	 */
	public function viewAction(Produit $produit)
	{	
		return $this->render('RamSavonBundle:Produit:view.html.twig', array( 'produit' => $produit));
	}

	public function addAction(Request $request)
	{
		if (!$this->get('security.context')->isGranted('ROLE_USER')) {
			throw new AccessDeniedException('Accès limité aux auteurs.');
		}

		$produit = new Produit();

		$form = $this->get('form.factory')->create(new ProduitType(), $produit);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($produit);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Produit bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_produit_view', array('id' => $produit->getId())));
		}

		return $this->render('RamSavonBundle:Produit:add.html.twig', array('form' => $form->createView()));
	}

	/**
 	 * @ParamConverter("produit", options={"mapping": {"produit_id": "id"}})
 	 */
	public function editAction(Produit $produit, Request $request)
	{
		$form = $this->get('form.factory')->create(new ProduitType(), $produit);
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($produit);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Produit bien enregistrée.');

			return $this->redirect($this->generateUrl('ram_produit_view', array('id' => $produit->getId())));
		}

		return $this->render('RamSavonBundle:Produit:edit.html.twig', array('produit' => $produit,'form' => $form->createView()));
	}

	/**
 	 * @ParamConverter("produit", options={"mapping": {"produit_id": "id"}})
 	 */
	public function deleteAction(Produit $produit, Request $request)
	{
		$form = $this->createFormBuilder()->getForm();

		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($produit);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "Le produit a bien été supprimée.");

			return $this->redirect($this->generateUrl('ram_produit_home'));
		}

		return $this->render('RamSavonBundle:Produit:delete.html.twig', array(
			'produit' => $produit,
			'form'   => $form->createView()
			));	
	}


	public function menuAction($limit)
	{
		$listProduits = array(
			array('id' => 2, 'title' => 'Savon Marseille'),
			array('id' => 5, 'title' => 'Savon Palmolive'),
			array('id' => 9, 'title' => 'Savon vaisselle')
			);

		return $this->render('RamSavonBundle:Produit:menu.html.twig', array( 'listProduits' => $listProduits	));
	}
}
