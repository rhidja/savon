<?php
// src/Ram/UserBundle/Entity/User.php

namespace Ram\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * @ORM\Entity
 */
class User implements BaseUser
{
  	/**
   	 * @ORM\Column(name="id", type="integer")
   	 * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
   	 */
  	private $id;
}