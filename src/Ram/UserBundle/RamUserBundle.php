<?php
// src/Ram/UserBundle/RamUserBundle.php

namespace Ram\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RamUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
