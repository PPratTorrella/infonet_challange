<?php

namespace App\Service;

use App\Command\StarWarsImportCommand;
use App\Exception\ApiException;
use App\Service\Api\ApiRequestService;
use App\Service\Data\CharacterService;
use App\Service\Data\MovieService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class StarWarsImportService
{
	const API_KEY_RESULTS = 'results';
	const API_KEY_FILMS = 'films';

	private $entityManager;
	private $characterService;
	private $movieService;
	private $apiService;

	/**
	 * @param EntityManagerInterface $entityManager
	 * @param CharacterService $characterService
	 * @param MovieService $movieService
	 * @param ApiRequestService $apiService
	 */
	public function __construct(EntityManagerInterface $entityManager, CharacterService $characterService, MovieService $movieService, ApiRequestService $apiService)
	{
		$this->entityManager = $entityManager;
		$this->characterService = $characterService;
		$this->movieService = $movieService;
		$this->apiService = $apiService;
	}

	/**
	 * @return int number of imporeted characters and their movies
	 * @throws ApiException
	 * @throws ClientExceptionInterface
	 * @throws DecodingExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 */
	public function importStarWarsData(): int
	{
		$characters = [];
		$page = 1;

		while (count($characters) < StarWarsImportCommand::MAX_CHARACTERS) {
			$data = $this->apiService->getCharacters($page);

			foreach ($data[self::API_KEY_RESULTS] as $person) {
				if (count($characters) >= StarWarsImportCommand::MAX_CHARACTERS) {
					break;
				}

				$character = $this->characterService->createCharacterFromArray($person);
				$characters[] = $character;

				$this->movieService->associateMoviesToCharacter($character, $person[self::API_KEY_FILMS]);
			}

			$page++;
		}

		$this->entityManager->flush();
		return count($characters);
	}
}
