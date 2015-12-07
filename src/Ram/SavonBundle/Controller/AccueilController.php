<?php

namespace Ram\SavonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends Controller
{
	public function indexAction()
	{
		return $this->render('RamSavonBundle:Accueil:index.html.twig');
	}
}
