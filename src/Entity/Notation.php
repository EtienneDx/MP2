<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="notations")
*/
class Notation
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	**/
  private $id;

	/**
	* @ORM\Column(type="integer")
	**/
  private $note;

	/**
	* @ORM\Column(type="datetime")
	**/
  private $date;

	/**
	* @ORM\ManyToOne(targetEntity="User", inversedBy="notations")
	* @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
	**/
  private $user;

	/**
	* @ORM\ManyToOne(targetEntity="Train", inversedBy="notations")
	* @ORM\JoinColumn(name="train_id", referencedColumnName="id")
	**/
  private $train;

	public function __construct($note, $date, $user, $train)
	{
    $this->note = $note;
		$this->date = $date;
		$this->user = $user;
		$this->train = $train;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNote($note)
	{
		$this->note = $note;
		return $this;
	}

	public function getNote()
	{
		return $this->note;
	}

	public function setDate($date)
	{
		$this->date = $date;
		return $this;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setUser($user)
	{
		$this->user = $user;
		return $this;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setTrain($train)
	{
		$this->train = $train;
		return $this;
	}

	public function getTrain()
	{
		return $this->train;
	}
}
