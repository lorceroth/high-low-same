<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DeckService;

/**
 * @Route("/decks")
 */
class DecksController extends AbstractController
{
    private $decks;

    public function __construct(DeckService $decks)
    {
        $this->decks = $decks;
    }

    /**
     * @Route("/new", methods={"GET"}, name="new_deck")
     */
    public function new(): Response
    {
        $deck = $this->decks->getNewDeck();

        return $this->json($deck);
    }

    /**
     * @Route("/{deckId}/draw", methods={"GET"}, name="draw_card")
     */
    public function draw(string $deckId): Response
    {
        $deck = $this->decks->drawCard($deckId);

        return $this->json($deck);
    }

    /**
     * @Route("/{deckId}/restart", methods={"GET"}, name="restart_game")
     */
    public function restart(string $deckId): Response
    {
        $deck = $this->decks->reshuffleCards($deckId);

        return $this->json($deck);
    }
}
