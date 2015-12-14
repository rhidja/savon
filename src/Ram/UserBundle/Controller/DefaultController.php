<?php

namespace Ram\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RamUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
