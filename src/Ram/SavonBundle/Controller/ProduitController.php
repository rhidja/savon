<?php

namespace Ram\SavonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
	public function indexAction($page)
	{
		if ($page < 1) 
		{
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		
		return $this->render('RamSavonBundle:Produit:index.html.twig');
	}

	public function viewAction($id)
	{
		return $this->render('RamSavonBundle:Produit:view.html.twig', array('id' => $id	));
	}

	public function addAction(Request $request)
	{
		if ($request->isMethod('POST')) 
		{
			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
			return $this->redirectToRoute('ram_savon_view', array('id' => 5));
		}

		return $this->render('RamSavonBundle:Produit:add.html.twig');
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
}
