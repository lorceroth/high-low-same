<?php

namespace App\Service;

use App\Api\DeckApiInterface;
use App\Model\Card;
use App\Model\Deck;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class DeckService
{
    /**
     * @var DeckApiInterface
     */
    private $api;

    /**
     * @var array
     */
    private $mappingProperties;

    /**
     * @var \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    private $accessor;

    public function __construct(DeckApiInterface $api)
    {
        $this->api = $api;
        $this->mappingProperties = $api->getMappingProperties();
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    public function getNewDeck(): Deck
    {
        $response = $this->api->getNewDeck();

        return $this->createDeckFromResponse($response);
    }

    public function drawCard(string $deckId): Deck
    {
        $response = $this->api->drawCard($deckId);

        return $this->createDeckFromResponse($response);
    }

    public function reshuffleCards(string $deckId): Deck
    {
        $response = $this->api->reshuffleCards($deckId);

        return $this->createDeckFromResponse($response);
    }

    private function createDeckFromResponse(ResponseInterface $response): Deck
    {
        $deck = new Deck();
        $data = json_decode($response->getBody(), true);

        $mappingProperties = $this->mappingProperties;
        $accessor = $this->accessor;

        $deck->setId(
            $accessor->getValue($data, '['.$this->mappingProperties['id'].']')
        );

        $deck->setRemaining(
            $accessor->getValue($data, '['.$this->mappingProperties['remaining'].']')
        );

        $cards = $accessor->getValue($data, '['.$this->mappingProperties['cards'].']');

        if (null !== $cards) {
            $deck->addCards($this->createCardsFromArray($data));
        }

        return $deck;
    }

    private function createCardsFromArray(array $data): array
    {
        $cards = [];

        $mappingProperties = $this->mappingProperties['cardProperties'];
        $accessor = $this->accessor;

        foreach ($data[$this->mappingProperties['cards']] as $cardData) {
            $card = new Card();

            $card->setCode(
                $accessor->getValue($cardData, '['.$mappingProperties['code'].']')
            );

            $card->setSuit(
                $accessor->getValue($cardData, '['.$mappingProperties['suit'].']')
            );

            $card->setValue(
                $accessor->getValue($cardData, '['.$mappingProperties['value'].']')
            );

            $card->setImage(
                $accessor->getValue($cardData, '['.$mappingProperties['image'].']')
            );

            $cards[] = $card;
        }

        return $cards;
    }
}
