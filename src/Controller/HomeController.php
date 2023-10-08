<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
	private $characterRepository;
	private $entityManager;

	public function __construct(CharacterRepository $characterRepository, EntityManagerInterface $entityManager)
	{
		$this->characterRepository = $characterRepository;
		$this->entityManager = $entityManager;
	}

	/**
	 * @Route("/home", name="app_home")
	 */
	public function index(Request $request): Response
	{
		$searchTerm = $request->request->get('search', '');
		$characters = $this->characterRepository->findByNameLike($searchTerm);

		return $this->render('home/index.html.twig', [
			'characters' => $characters,
			'searchTerm' => $searchTerm
		]);
	}

	/**
	 * @Route("/character/edit/{id}", name="character_edit", methods={"GET", "POST"})
	 */
	public function edit(Request $request, int $id): Response
	{
		$entityManager = $this->container->get('doctrine');
		$character = $entityManager->getRepository(Character::class)->find($id);

		if (!$character) {
			throw $this->createNotFoundException('No character found for id ' . $id);
		}

		$form = $this->createForm(CharacterType::class, $character);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->entityManager->flush();
			return $this->redirectToRoute('app_home');
		}

		return $this->render('home/edit.html.twig', [
			'character' => $character,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/character/delete/{id}", name="character_delete", methods={"POST"})
	 */
	public function delete(int $id): Response
	{
		$entityManager = $this->container->get('doctrine');
		$character = $entityManager->getRepository(Character::class)->find($id);

		$this->entityManager->remove($character);
		$this->entityManager->flush();

		return $this->redirectToRoute('app_home');
	}
}
