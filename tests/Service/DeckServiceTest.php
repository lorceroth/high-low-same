<?php

namespace App\Tests\Service;

use App\Api\DeckTestApi;
use App\Model\Card;
use App\Service\DeckService;
use PHPUnit\Framework\TestCase;

class DeckServiceTest extends TestCase
{
    public function testGetNewDeck()
    {
        $decks = $this->createDeckService();
        $deck = $decks->getNewDeck();

        $this->assertNotNull($deck->getId());
        $this->assertNotNull($deck->getRemaining());
        $this->assertTrue($deck->getCards()->isEmpty());
    }

    public function testDrawCard()
    {
        $decks = $this->createDeckService();
        $deck = $decks->getNewDeck();
        $deck = $decks->drawCard($deck->getId());

        $this->assertInstanceOf(Card::class, $deck->getCards()->first());
    }

    public function testReshuffleCards()
    {
        $decks = $this->createDeckService();
        $deck = $decks->getNewDeck();

        $this->assertSame(52, $deck->getRemaining());

        $deck = $decks->drawCard($deck->getId());

        $this->assertSame(51, $deck->getRemaining());

        $deck = $decks->reshuffleCards($deck->getId());

        $this->assertSame(52, $deck->getRemaining());
    }

    /**
     * To avoid creating 100s of new decks every test, we use a DeckTestApi class
     * that implements the DeckApiInterface and simulates the
     * logic from the DeckOfCards API.
     *
     * @return DeckApiInterface
     */
    private function createDeckService(): DeckService
    {
        $api = new DeckTestApi();

        return new DeckService($api);

        // $client = new Client();
        // $api = new DeckOfCardsApi($client);

        // return new DeckService($api);
    }
}
