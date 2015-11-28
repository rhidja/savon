<?php
// src/Ram/SavonBundle/DataFixtures/ORM/LoadProduit.php

namespace Ram\SavonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ram\SavonBundle\Entity\Produit;

class LoadProduit implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$noms = array(
			"Savon marseille",
			"Savon lavande",
			"Savon à l'huile",
			"Savon à l'huile d'argant",
			);

		foreach ($noms as $nom) {
			$produit = new Produit();
			$produit->setNom($nom);
			$produit->setType("Savon");
			$produit->setDescription("Savon bio naturel et respecteux de l'environnement...");
			$manager->persist($produit);
		}

		$manager->flush();
	}
}