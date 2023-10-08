<?php

namespace App\Command;

use App\Exception\ApiException;
use App\Service\StarWarsImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class StarWarsImportCommand extends Command
{

	const MAX_CHARACTERS = 30;

	protected static $defaultName = 'starwars:import';
	private $starWarsImportService;


	/**
	 * @param StarWarsImportService $starWarsImportService
	 * @param string|null $name
	 */
	public function __construct(StarWarsImportService $starWarsImportService, string $name = null)
	{
		parent::__construct($name);
		$this->starWarsImportService = $starWarsImportService;
	}

	protected function configure()
	{
		$this->setDescription('Imports characters and movies from the Star Wars API.');
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @throws ApiException
	 * @throws ClientExceptionInterface
	 * @throws DecodingExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 * @return int
	 */
	public function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('Fetching and importing Star Wars characters...');

		$importedCount = $this->starWarsImportService->importStarWarsData();

		$output->writeln(sprintf('%d characters imported successfully!', $importedCount));

		return Command::SUCCESS;
	}


}
