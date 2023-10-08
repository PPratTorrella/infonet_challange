<?php

namespace App\Service\Data;

use App\Entity\ApiLog;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;

class ApiLogService
{

	/**
	 * @var ManagerRegistry
	 */
	private $managerRegistry;

	public function __construct(ManagerRegistry $managerRegistry)
	{
		$this->managerRegistry = $managerRegistry;
	}

	/**
	 * @todo to keep some history logs
	 * Create a new ApiLog entity and persist it to the database.
	 *
	 * @param string $endpoint
	 * @param string $method
	 * @param string $responsePayload
	 * @param int $statusCode
	 * @param DateTime $timestamp
	 * @return ApiLog
	 */
	public function createApiLog(string $endpoint, string $method, string $responsePayload, int $statusCode, DateTime $timestamp): ApiLog
	{
		$apiLog = new ApiLog(); // consider factory if this could get complex or some way of injecting if too tightly coupled

		$apiLog
			->setEndpoint($endpoint)
			->setMethod($method)
			->setResponsePayload($responsePayload)
			->setStatusCode($statusCode)
			->setTimestamp($timestamp);

		// persisting could be extracted to have more control
		$entityManager = $this->managerRegistry->getManagerForClass(ApiLog::class);
		$entityManager->persist($apiLog);
		$entityManager->flush();

		return $apiLog;
	}
}