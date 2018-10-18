<?php

namespace App\Controller\Api;

use App\Comparer\CardComparer;
use App\Model\Card;
use App\Service\DeckService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/decks")
 */
class DecksController extends AbstractController
{
    /**
     * @var DeckService
     */
    private $decks;

    /**
     * @var CardComparer
     */
    private $comparer;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        DeckService $decks,
        CardComparer $comparer,
        SerializerInterface $serializer)
    {
        $this->decks = $decks;
        $this->comparer = $comparer;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/new", methods={"GET"}, name="new_deck")
     */
    public function new(): Response
    {
        $deck = $this->decks->getNewDeck();
        $deck = $this->decks->drawCard($deck->getId());

        return $this->json([
            'deck' => $deck,
        ]);
    }

    /**
     * @Route("/{id}/draw", methods={"POST"}, name="draw_card")
     */
    public function draw($id, Request $request): Response
    {
        $choice = strtolower($request->query->get('choice'));
        $oldCard = $this->serializer->deserialize($request->getContent(), Card::class, 'json');

        $deck = $this->decks->drawCard($id);
        $newCard = $deck->getFirstCard();

        $isCorrect = $this->comparer->compare($newCard, $oldCard, $choice);

        return $this->json([
            'isCorrect' => $isCorrect,
            'deck' => $deck,
        ]);
    }

    /**
     * @Route("/{id}/restart", methods={"GET"}, name="restart_game")
     */
    public function restart(string $id): Response
    {
        $deck = $this->decks->reshuffleCards($id);
        $deck = $this->decks->drawCard($id);

        return $this->json([
            'deck' => $deck,
        ]);
    }
}
