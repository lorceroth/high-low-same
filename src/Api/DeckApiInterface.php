<?php

namespace App\Api;

use Psr\Http\Message\ResponseInterface;

interface DeckApiInterface
{
    /**
     * Maps the model properties to the JSON keys.
     *
     * @return array
     */
    public function getMappingProperties(): array;

    /**
     * Gets a brand new deck.
     *
     * @return void
     */
    public function getNewDeck(): ResponseInterface;

    /**
     * Draw a card from a deck.
     *
     * @param string $deckId
     * @return void
     */
    public function drawCard(string $deckId): ResponseInterface;

    /**
     * Reshuffles the cards in an existing deck.
     *
     * @param string $deckId
     * @return void
     */
    public function reshuffleCards(string $deckId): ResponseInterface;
}
