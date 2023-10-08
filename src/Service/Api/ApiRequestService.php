<?php

namespace App\Service\Api;

use App\Exception\ApiException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiRequestService
{
	const GET = 'GET';
	const API_FAIL_MESSAGE_PREFIX = 'API request failed: ';

	private $httpClient;
	private $uri;
	private $endpointPeople;
	private $endpointMovies;

	/**
	 * @param HttpClientInterface $httpClient
	 * @param string $baseUri
	 * @param string $endpointPeople
	 * @param string $endpointMovies
	 */
	public function __construct(HttpClientInterface $httpClient, string $baseUri, string $endpointPeople, string $endpointMovies)
	{
		$this->httpClient = $httpClient;
		$this->uri = $baseUri;
		$this->endpointPeople = $endpointPeople;
		$this->endpointMovies = $endpointMovies;
	}

	/**
	 * @param int $page
	 *
	 * @throws ApiException
	 * @throws ClientExceptionInterface
	 * @throws DecodingExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 * @return array
	 */
	public function getCharacters(int $page = 1): array
	{
		$endpoint = sprintf($this->endpointPeople, $page);
		$response = $this->httpClient->request(self::GET, $this->uri . $endpoint);

		if ($response->getStatusCode() === Response::HTTP_OK) {
			return $response->toArray();
		}

		throw new ApiException(self::API_FAIL_MESSAGE_PREFIX . $response->getContent());
	}

	/**
	 * @todo later for the bonus page
	 *
	 * @throws ApiException
	 * @throws ClientExceptionInterface
	 * @throws DecodingExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 * @return array
	 */
	public function getMovies(): array
	{
		$response = $this->httpClient->request(self::GET, $this->uri . $this->endpointMovies);

		if ($response->getStatusCode() === Response::HTTP_OK) {
			return $response->toArray();
		}

		throw new ApiException(self::API_FAIL_MESSAGE_PREFIX . $response->getContent());
	}

	/**
	 * @param string $url
	 * @throws ApiException
	 * @throws ClientExceptionInterface
	 * @throws DecodingExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 * @return array
	 */
	public function getMovieByUrl(string $url): array
	{
		$response = $this->httpClient->request(self::GET, $url);

		if ($response->getStatusCode() === Response::HTTP_OK) {
			return $response->toArray();
		}

		throw new ApiException(self::API_FAIL_MESSAGE_PREFIX . $response->getContent());
	}

}
