<?php

namespace App\Service\Data;

use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;

class CharacterService
{
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @param array $data
	 * @return Character
	 */
	public function createCharacterFromArray(array $data): Character
	{
		$character = new Character();

		$character->setName($data['name'])
			->setMass($data['mass'])
			->setHeight($data['height'])
			->setGender($data['gender'])
			->setPicture('Path to picture');

		$this->entityManager->persist($character);
		return $character;
	}
}
