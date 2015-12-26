<?php
// src/Ram/SavonBundle/Beta/BetaHTML.php

namespace Ram\SavonBundle\Beta;

use Symfony\Component\HttpFoundation\Response;

class BetaHTML
{
	public function displayBeta(Response $response, $remainingDays)
	{
		$content = $response->getContent();

		$html = '<span style="color: red; font-size: 0.5em;"> - Beta J-'.(int) $remainingDays.' !</span>';

		$content = preg_replace(
			'#<h1>(.*?)</h1>#iU',
			'<h1>$1'.$html.'</h1>',
			$content,
			1
			);

		$response->setContent($content);

		return $response;
	}
}