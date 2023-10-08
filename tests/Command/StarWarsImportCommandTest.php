<?php

namespace App\Tests\Command;

use App\Command\StarWarsImportCommand;
use App\Service\StarWarsImportService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class StarWarsImportCommandTest extends TestCase
{
	/**
	 * @var MockObject|StarWarsImportService
	 */
	private $starWarsImportServiceMock;

	/**
	 * @var StarWarsImportCommand
	 */
	private $starWarsImportCommand;

	public function setUp(): void
	{
		$this->starWarsImportServiceMock = $this->createMock(StarWarsImportService::class);
		$this->starWarsImportCommand = new StarWarsImportCommand($this->starWarsImportServiceMock);
	}

	/*public function testImportStarWarsData()
	{
		$this->starWarsImportServiceMock->expects($this->once())
			->method('importStarWarsData')
			->willReturn(30);

		$importedCount = $this->starWarsImportCommand->execute(new InputInterface([]), new OutputInterface([])); //@todo

		$this->assertEquals(30, $importedCount);
	}*/
}