<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="trains")
*/
class Train
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
  private $name;

	/**
	* @ORM\Column(type="datetime")
	**/
  private $lastCleanup;

	/**
	* @ORM\OneToMany(targetEntity="Notation", mappedBy="train")
	*/
	private $notations;

	public function __construct($name, $lastCleanup)
	{
		$this->name = $name;
		$this->lastCleanup = $lastCleanup;
		$this->notation = new ArrayCollection();
	}

	public function getId()
	{
		return $this->id;
	}

  public function getTotal_note()
  {
    $i = 0;
    foreach ($this->notations as $n)
    {
        $i=$i+$n->getNote();
    }
    return $i;
  }


	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getLastCleanup()
	{
		return $this->lastCleanup;
	}

	public function setLastCleanup($lastCleanup)
	{
		$this->lastCleanup = $lastCleanup;
		return $this;
	}

	public function getNotations()
	{
		return $this->notations;
	}

  public function getNote()
  {
    $n = 0;
    $c = 0;
    foreach ($this->notations as $note)
    {
      if($note->getDate() > $this->getLastCleanup())
      {
        $c++;
        $n += $note->getNote();
      }
    }
    if($c > 0)
    {
      return $n / $c;
    }
    return 5;// no notations mean still clean
  }

  public function getNotationsCount()
  {
    $c = 0;
    foreach ($this->notations as $note)
    {
      if($note->getDate() > $this->getLastCleanup())
      {
        $c++;
      }
    }
    return $c;
  }

	public function addNotation($notation)
	{
		array_push($this->notations, $notation);
	}
}
