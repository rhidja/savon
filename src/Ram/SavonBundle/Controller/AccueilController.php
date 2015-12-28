<?php

namespace Ram\SavonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends Controller
{
	public function indexAction()
	{
		$mailer = $this->container->get('mailer'); 

		$antispam = $this->container->get('ram_savon.antispam');

/*		$text = '...';
		if ($antispam->isSpam($text)) {
			throw new \Exception('Votre message a été détecté comme spam !');
		}*/

		return $this->render('RamSavonBundle:Accueil:index.html.twig');
	}


	public function translationAction($name)
	{
		return $this->render('RamSavonBundle:Accueil:translation.html.twig', array(
			'name' => $name
			));
	}
	
}
