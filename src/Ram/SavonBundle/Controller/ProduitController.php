<?php

namespace Ram\SavonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    public function indexAction()
    {
        return $this->render('RamSavonBundle:Produit:index.html.twig');
    }
}
