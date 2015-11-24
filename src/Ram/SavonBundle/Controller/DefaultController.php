<?php

namespace Ram\SavonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RamSavonBundle:Default:index.html.twig', array('name' => $name));
    }
}
