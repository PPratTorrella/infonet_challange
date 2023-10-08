<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\ManyToMany(targetEntity="Character", mappedBy="movies")
	 */
	private $characters;


	public function __construct()
	{
		$this->characters = new ArrayCollection();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return Collection|Character[]
	 */
	public function getCharacters()
	{
		return $this->characters;
	}

	public function addCharacter(Character $character)
	{
		if (!$this->characters->contains($character)) {
			$this->characters[] = $character;
			$character->addMovie($this);
		}

		return $this;
	}

	public function removeCharacter(Character $character): self
	{
		if ($this->characters->contains($character)) {
			$this->characters->removeElement($character);
			$character->removeMovie($this);
		}

		return $this;
	}
}
