<?php
// src/Ram/SavonBundle/Beta/BetaListener.php

namespace Ram\SavonBundle\Beta;

use Symfony\Component\HttpFoundation\Response;

class BetaListener
{
	protected $betaHTML;

	protected $endDate;

	public function __construct(BetaHTML $betaHTML, $endDate)
	{
		$this->betaHTML = $betaHTML;
		$this->endDate  = new \Datetime($endDate);
	}

	public function processBeta()
	{
		$remainingDays = $this->endDate->diff(new \Datetime())->format('%d');

		if ($remainingDays <= 0) {
			return;
		}

		// Ici on appelera la méthode
		// $this->betaHTML->displayBeta()
	}
}