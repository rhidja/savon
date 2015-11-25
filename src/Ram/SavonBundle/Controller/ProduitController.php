<?php

namespace Ram\SavonBundle\Controller;

use Ram\SavonBundle\Entity\Produit;
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

		$listProduits = array(
			array(
				'title'   => 'Recherche développpeur Symfony2',
				'id'      => 1,
				'author'  => 'Alexandre',
				'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
				'date'    => new \Datetime()),
			array(
				'title'   => 'Mission de webmaster',
				'id'      => 2,
				'author'  => 'Hugo',
				'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
				'date'    => new \Datetime()),
			array(
				'title'   => 'Offre de stage webdesigner',
				'id'      => 3,
				'author'  => 'Mathieu',
				'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
				'date'    => new \Datetime())
			);
    
		return $this->render('RamSavonBundle:Produit:index.html.twig', array( 'listProduits' => $listProduits ));
	}

	public function viewAction($id)
	{	
		$repository = $this->getDoctrine()->getManager()->getRepository('RamSavonBundle:Produit');

		$produit = $repository->find($id);

		if (null === $produit) {
			throw new NotFoundHttpException("Le savon d'id ".$id." n'existe pas.");
		}

		return $this->render('RamSavonBundle:Produit:view.html.twig', array( 'produit' => $produit ));
	}

	public function addAction(Request $request)
	{
		if ($request->isMethod('POST')) 
		{
			$request->getSession()->getFlashBag()->add('notice', 'Le savon est bien enregistrée.');
			return $this->redirectToRoute('ram_savon_view', array('id' => 5));
		}

	    $produit = new Produit();
	    $produit->setNom('Savon Marseille.');
	    $produit->setType('Savon');
	    $produit->setDescription("Savon de Marseille fait à l'ancienne...");
	    
	    $em = $this->getDoctrine()->getManager();
	    $em->persist($produit);
	    $em->flush();

	    if ($request->isMethod('POST')) {
	      $request->getSession()->getFlashBag()->add('notice', 'Le savon est bien enregistrée.');
	      return $this->redirect($this->generateUrl('ram_savon_view', array('id' => $produit->getId())));
	    }

		return $this->render('RamSavonBundle:Produit:index.html.twig', array( 'listProduits' => array() ));
	}

	public function editAction($id, Request $request)
	{
		if ($request->isMethod('POST')) 
		{
			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
			return $this->redirectToRoute('ram_savon_view', array('id' => 5));
		}

		return $this->render('RamSavonBundle:Produit:edit.html.twig');
	}

	public function deleteAction($id)
	{
		return $this->render('RamSavonBundle:Produit:delete.html.twig');
	}


	public function menuAction($limit)
	{
	  	$listProduits = array(
	  		array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
	  		array('id' => 5, 'title' => 'Mission de webmaster'),
	  		array('id' => 9, 'title' => 'Offre de stage webdesigner')
	  		);

	  	return $this->render('RamSavonBundle:Produit:menu.html.twig', array( 'listProduits' => $listProduits	));
	  }
}
