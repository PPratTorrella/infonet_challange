<?php

namespace App\Service\Data;

use App\Entity\Character;
use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Api\ApiRequestService;

class MovieService
{
	private $entityManager;
	private $apiService;

	public function __construct(EntityManagerInterface $entityManager, ApiRequestService $apiService)
	{
		$this->entityManager = $entityManager;
		$this->apiService = $apiService;
	}

	public function associateMoviesToCharacter(Character $character, array $filmUrls): void
	{
		foreach ($filmUrls as $filmUrl) {
			$filmData = $this->apiService->getMovieByUrl($filmUrl);

			$movie = $this->entityManager->getRepository(Movie::class)->findOneBy(['name' => $filmData['title']]);
			if (!$movie) {
				$movie = new Movie();
				$movie->setName($filmData['title']);
				$this->entityManager->persist($movie);
			}

			$character->addMovie($movie);
		}
	}
}
