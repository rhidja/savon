<?php
// src/Ram/SavonBundle/Antispam/RamAntispam.php

namespace Ram\SavonBundle\Antispam;

class RamAntispam extends \Twig_Extension
{
	private $mailer;
	private $locale;
	private $minLength;

	public function __construct(\Swift_Mailer $mailer, $minLength)
	{
		$this->mailer    = $mailer;
		$this->minLength = (int) $minLength;
	}

	public function isSpam($text)
	{
		return strlen($text) < $this->minLength;
	}

	public function getFunctions()
	{
		return array(
			'checkIfSpam' => new \Twig_Function_Method($this, 'isSpam')
			);
	}

	public function getName()
	{
		return 'OCAntispam';
	}
		
	public function setLocale($locale)
	{
		$this->locale = $locale;
	}
}