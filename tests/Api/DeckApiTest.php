<?php

namespace App\Tests\Api;

use App\Api\DeckApiInterface;
use App\Api\DeckOfCardsApi;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use App\Api\DeckTestApi;

class DeckApiTest extends TestCase
{
    public function testGetNewDeck()
    {
        $api = $this->createApi();
        $response = $api->getNewDeck();
        $deck = json_decode($response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($deck['deck_id']);
        $this->assertNotNull($deck['remaining']);
    }

    public function testDrawCard()
    {
        $api = $this->createApi();
        $firstResponse = $api->getNewDeck();
        $firstDeck = json_decode($firstResponse->getBody(), true);

        // Draw a card
        $secondResponse = $api->drawCard($firstDeck['deck_id']);
        $secondDeck = json_decode($secondResponse->getBody(), true);

        $this->assertEquals(200, $firstResponse->getStatusCode());
        $this->assertEquals(52, $firstDeck['remaining']);

        $this->assertEquals(200, $secondResponse->getStatusCode());
        $this->assertEquals(51, $secondDeck['remaining']);
    }

    public function testReshuffleCards()
    {
        $api = $this->createApi();
        $firstResponse = $api->getNewDeck();
        $firstDeck = json_decode($firstResponse->getBody(), true);

        // Draw a card
        $secondResponse = $api->drawCard($firstDeck['deck_id']);
        $secondDeck = json_decode($secondResponse->getBody(), true);

        // Reshuffle deck
        $thirdResponse = $api->reshuffleCards($firstDeck['deck_id']);
        $thirdDeck = json_decode($thirdResponse->getBody(), true);

        $this->assertEquals(200, $firstResponse->getStatusCode());
        $this->assertEquals(52, $firstDeck['remaining']);

        $this->assertEquals(200, $secondResponse->getStatusCode());
        $this->assertEquals(51, $secondDeck['remaining']);

        $this->assertEquals(200, $thirdResponse->getStatusCode());
        $this->assertEquals(52, $thirdDeck['remaining']);
    }

    /**
     * To avoid creating 100s of new decks every test, we use a DeckTestApi class
     * that implements the DeckApiInterface and simulates the
     * logic from the DeckOfCards API.
     *
     * @return DeckApiInterface
     */
    private function createApi(): DeckApiInterface
    {
        return new DeckTestApi();

        // $client = new Client();
        // $api = new DeckOfCardsApi($client);

        // return $api;
    }
}
