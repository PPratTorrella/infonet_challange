<?php

namespace App\Tests\Service\Data;

use App\Entity\Character;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Service\Data\MovieService;
use App\Service\Api\ApiRequestService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MovieServiceTest extends TestCase
{
	/**
	 * @var MockObject|EntityManagerInterface
	 */
	private $entityManagerMock;

	/**
	 * @var MockObject|ApiRequestService
	 */
	private $apiServiceMock;

	/**
	 * @var MovieService
	 */
	private $movieService;

	protected function setUp(): void
	{
		$this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
		$this->apiServiceMock = $this->createMock(ApiRequestService::class);

		$this->movieService = new MovieService($this->entityManagerMock, $this->apiServiceMock);
	}


}