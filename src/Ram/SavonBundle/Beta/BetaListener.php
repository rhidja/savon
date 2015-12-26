<?php
// src/Ram/SavonBundle/Beta/BetaListener.php

namespace Ram\SavonBundle\Beta;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class BetaListener
{
	protected $betaHTML;

	protected $endDate;

	public function __construct(BetaHTML $betaHTML, $endDate)
	{
		$this->betaHTML = $betaHTML;
		$this->endDate  = new \Datetime($endDate);
	}

	public function processBeta(FilterResponseEvent $event)
	{
		if (!$event->isMasterRequest()) {
			return;
		}

		$remainingDays = $this->endDate->diff(new \Datetime())->format('%d');

		if ($remainingDays <= 0) {
			return;
		}

		$response = $this->betaHTML->displayBeta($event->getResponse(), $remainingDays);
		$event->setResponse($response);
	}
	
	public function ignoreBeta()
	{
		# TODO
	}
}