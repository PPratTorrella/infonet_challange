<?php
namespace App\Service\Api;

class ApiResultService
{
	/**
	 * @todo so we dont depend on format of api that could change
	 * Transforms/validates raw API data into a structured format for the app to not depend on raw api results.
	 *
	 * @param array $rawData The raw data from the API.
	 * @return array The structured data.
	 */
	public function formatApiRawData(array $rawData): array
	{
		return array_map(function ($movie) {
			return [
				'title' => $movie['title'] ?? 'Unknown Title',
			];
		}, $rawData);
	}
}
