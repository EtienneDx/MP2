<?php

namespace Entity;

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

	/**
	* @ORM\OneToMany(targetEntity="Notation", mappedBy="train")
	*/
	private $notations;

	public function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
		$this->notations = new ArrayCollection();
	}

	public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getNotations()
	{
		return $this->notations;
	}

	public function addNotation($notation)
	{
		array_push($this->notations, $notation);
	}
}
