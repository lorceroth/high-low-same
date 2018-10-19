<?php

namespace App\Api;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class DeckOfCardsApi implements DeckApiInterface
{
    const BASE_URL = 'http://deckofcardsapi.com/api/deck';

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function getNewDeck(): ResponseInterface
    {
        return $this->client->request('GET', self::BASE_URL.'/new/shuffle');
    }

    /**
     * {@inheritdoc}
     */
    public function drawCard(string $deckId): ResponseInterface
    {
        return $this->client->request('GET', self::BASE_URL.'/'.$deckId.'/draw', [
            'query' => [
                'count' => 1,
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function reshuffleCards(string $deckId): ResponseInterface
    {
        return $this->client->request('GET', self::BASE_URL.'/'.$deckId.'/shuffle');
    }
}
