<?php

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="users")
*/
class User
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	**/
  private $id;

	/**
	* @ORM\Column(type="string")
	**/
  private $username;

	/**
	* @ORM\Column(type="string")
	**/
  private $password;
}
