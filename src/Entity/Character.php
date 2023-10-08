<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 */
class Character
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
	 * @ORM\Column(type="float")
	 */
	private $mass;

	/**
	 * @ORM\Column(type="float")
	 */
	private $height;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	private $gender;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $picture;

//	/** //@todo try this lib for saving images
//	 * @Vich\UploadableField(mapping="character_image", fileNameProperty="picture")
//	 */
//	private $imageFile;

	/**
	 * @ORM\ManyToMany(targetEntity="Movie", inversedBy="characters")
	 * @ORM\JoinTable(name="movies_characters")
	 */
	private $movies;


	public function __construct()
	{
		$this->movies = new ArrayCollection();
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

	public function getMass()
	{
		return $this->mass;
	}

	public function setMass($mass)
	{
		$this->mass = $mass;

		return $this;
	}

	public function getHeight()
	{
		return $this->height;
	}

	public function setHeight($height)
	{
		$this->height = $height;

		return $this;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function setGender($gender)
	{
		$this->gender = $gender;

		return $this;
	}

	public function getPicture()
	{
		return $this->picture;
	}

	public function setPicture($picture)
	{
		$this->picture = $picture;

		return $this;
	}

	/**
	 * @return Collection|Movie[]
	 */
	public function getMovies()
	{
		return $this->movies;
	}

	public function addMovie(Movie $movie)
	{
		if (!$this->movies->contains($movie)) {
			$this->movies[] = $movie;
		}

		return $this;
	}

	public function removeMovie(Movie $movie): self
	{
		$this->movies->removeElement($movie);

		return $this;
	}
}
