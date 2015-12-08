<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Produit;
use Ram\SavonBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

	public function viewAction($id)
	{	
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Produit');

		$produit = $repository->find($id);

		if (null === $produit) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

		return $this->render('RamSavonBundle:Produit:view.html.twig', array( 'produit' => $produit));
	}

	public function addAction(Request $request)
	{
		
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

	public function editAction($id, Request $request)
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Produit');

		$produit = $repository->find($id);

		if (null === $produit) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

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

	public function deleteAction($id)
	{
		return $this->render('RamSavonBundle:Produit:delete.html.twig');
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
