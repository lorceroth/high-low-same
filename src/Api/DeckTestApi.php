<?php

namespace App\Api;

use Psr\Http\Message\ResponseInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * This class is a simple mock of Deck of Cards API to avoid creating 100s of
 * new decks when running tests. *cough* :)
 */
class DeckTestApi implements DeckApiInterface
{
    /**
     * @var DiactorosFactory
     */
    private $psr7factory;

    /**
     * @var ?array
     */
    private $deck = null;

    /**
     * @var array
     */
    private $cards = [];

    public function __construct()
    {
        $this->psr7factory = new DiactorosFactory();

        $this->cards = $this->createCards();
    }

    public function getMappingProperties(): array
    {
        return [
            'id' => 'deck_id',
            'remaining' => 'remaining',
            'cards' => 'cards',
            'cards.properties' => [
                'code' => 'code',
                'suit' => 'suit',
                'value' => 'value',
                'image' => 'image',
            ],
        ];
    }

    public function getNewDeck(): ResponseInterface
    {
        $this->deck = $this->createDeck();

        $response = new JsonResponse($this->deck);

        return $this->psr7factory->createResponse($response);
    }

    public function drawCard(string $deckId): ResponseInterface
    {
        if (null === $this->deck) {
            $this->deck = $this->createDeck();
        }

        --$this->deck['remaining'];

        $card = $this->cards[array_rand($this->cards)];
        $this->deck['cards'] = [$card];

        $response = new JsonResponse($this->deck);

        return $this->psr7factory->createResponse($response);
    }

    public function reshuffleCards(string $deckId): ResponseInterface
    {
        if (null === $this->deck) {
            $this->deck = $this->createDeck();
        }

        $this->deck['remaining'] = 52;

        $response = new JsonResponse($this->deck);

        return $this->psr7factory->createResponse($response);
    }

    private function createDeck(): array
    {
        return [
            'success' => true,
            'deck_id' => 'abc123',
            'shuffled' => true,
            'remaining' => 52,
        ];
    }

    private function createCards(): array
    {
        $values = [
            'A' => 'ACE',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '0' => '10',
            'J' => 'JACK',
            'Q' => 'QUEEN',
            'K' => 'KING',
        ];

        $suits = [
            'S' => 'SPADES',
            'D' => 'DIAMONDS',
            'H' => 'HEARTS',
            'C' => 'CLUBS',
        ];

        $cards = [];

        foreach ($suits as $suitKey => $suit) {
            foreach ($values as $valueKey => $value) {
                $shortName = $valueKey.$suitKey;

                $cards[] = [
                    'image' => 'https://deckofcardsapi.com/static/img/'.$shortName.'.png',
                    'value' => $value,
                    'suit' => $suit,
                    'code' => $shortName,
                ];
            }
        }

        return $cards;
    }
}
