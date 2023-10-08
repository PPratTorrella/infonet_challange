<?php

namespace App\Tests\Service\Data;

use App\Entity\Character;
use App\Service\Data\CharacterService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CharacterServiceTest extends TestCase
{
	private $entityManager;
	private $characterService;

	protected function setUp(): void
	{
		$this->entityManager = $this->createMock(EntityManagerInterface::class);
		$this->characterService = new CharacterService($this->entityManager);
	}

	public function testCreateCharacterFromArray()
	{
		$characterData = [
			'name' => 'Luke Skywalker',
			'mass' => '77',
			'height' => '172',
			'gender' => 'male',
			'picture' => 'path_to_picture'
		];

		$character = $this->characterService->createCharacterFromArray($characterData);

		$this->assertInstanceOf(Character::class, $character);
		$this->assertEquals($characterData['name'], $character->getName());
	}
}