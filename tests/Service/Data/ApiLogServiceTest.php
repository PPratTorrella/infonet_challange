<?php

namespace App\Tests\Service\Data;

use App\Service\Data\ApiLogService;
use App\Entity\ApiLog;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use DateTime;
use PHPUnit\Framework\TestCase;

class ApiLogServiceTest extends TestCase
{
	private $managerRegistryMock;
	private $entityManagerMock;

	protected function setUp(): void
	{
		$this->entityManagerMock = $this->getMockBuilder(EntityManager::class)
			->disableOriginalConstructor()
			->getMock();

		$this->managerRegistryMock = $this->getMockBuilder(ManagerRegistry::class)
			->disableOriginalConstructor()
			->getMock();

		$this->managerRegistryMock->method('getManagerForClass')
			->willReturn($this->entityManagerMock);
	}

	public function testCreateApiLogOk()
	{
		$endpoint = '/api/test';
		$method = 'GET';
		$responsePayload = '{"data":"test"}';
		$statusCode = 200;
		$timestamp = new DateTime();

		$this->entityManagerMock->expects($this->once())->method('persist');
		$this->entityManagerMock->expects($this->once())->method('flush');

		$service = new ApiLogService($this->managerRegistryMock);

		$apiLog = $service->createApiLog($endpoint, $method, $responsePayload, $statusCode, $timestamp);

		$this->assertInstanceOf(ApiLog::class, $apiLog);
		$this->assertEquals($endpoint, $apiLog->getEndpoint());
		$this->assertEquals($method, $apiLog->getMethod());
		$this->assertEquals($responsePayload, $apiLog->getResponsePayload());
		$this->assertEquals($statusCode, $apiLog->getStatusCode());
		$this->assertEquals($timestamp, $apiLog->getTimestamp());
	}
}
