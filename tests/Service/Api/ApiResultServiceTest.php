<?php

namespace App\Tests\Service\Api;

use App\Service\Api\ApiResultService;
use PHPUnit\Framework\TestCase;

class ApiResultServiceTest extends TestCase
{
	private $apiResultService;

	protected function setUp(): void
	{
		$this->apiResultService = new ApiResultService();
	}

	public function testHandleTestApiTransformsDataCorrectly()
	{
		$rawData = [
			['title' => 'aaaa'],
			['title' => 'bbbb'],
			['noTitleKey' => 'This should be Unknown'],
		];

		$expectedResult = [
			['title' => 'aaaa'],
			['title' => 'bbbb'],
			['title' => 'Unknown Title'],
		];

		$this->assertSame($expectedResult, $this->apiResultService->formatApiRawData($rawData));
	}

	public function testHandleTestApiHandlesEmptyArray()
	{
		$this->assertSame([], $this->apiResultService->formatApiRawData([]));
	}
}
