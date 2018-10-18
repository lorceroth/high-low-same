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
     * @var \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    private $accessor;

    /**
     * @var array
     */
    private $mappingProperties;

    public function __construct(DeckApiInterface $api)
    {
        $this->api = $api;
        $this->accessor = PropertyAccess::createPropertyAccessor();
        $this->mappingProperties = $api->getMappingProperties();
    }

    public function getNewDeck(): Deck
    {
        $response = $this->api->getNewDeck();

        return $this->createDeckFromResponse($response);
    }

    public function drawCard(string $id): Deck
    {
        $response = $this->api->drawCard($id);

        return $this->createDeckFromResponse($response);
    }

    public function reshuffleCards(string $id): Deck
    {
        $response = $this->api->reshuffleCards($id);

        return $this->createDeckFromResponse($response);
    }

    private function createDeckFromResponse(ResponseInterface $response): Deck
    {
        $deck = new Deck();
        $data = json_decode($response->getBody(), true);

        $properties = $this->mappingProperties;
        $accessor = $this->accessor;

        $deck->setId(
            $accessor->getValue($data, sprintf('[%s]', $properties['id']))
        );

        $deck->setRemaining(
            $accessor->getValue($data, sprintf('[%s]', $properties['remaining']))
        );

        if ($accessor->getValue($data, sprintf('[%s]', $properties['cards']))) {
            $deck->addCards($this->createCardsFromArray($data));
        }

        return $deck;
    }

    private function createCardsFromArray(array $data): array
    {
        $cards = [];

        $properties = $this->mappingProperties['cards.properties'];
        $accessor = $this->accessor;

        foreach ($data[$this->mappingProperties['cards']] as $cardData) {
            $card = new Card();

            $card->setCode(
                $accessor->getValue($cardData, sprintf('[%s]', $properties['code']))
            );

            $card->setSuit(
                $accessor->getValue($cardData, sprintf('[%s]', $properties['suit']))
            );

            $card->setValue(
                $accessor->getValue($cardData, sprintf('[%s]', $properties['value']))
            );

            $card->setImage(
                $accessor->getValue($cardData, sprintf('[%s]', $properties['image']))
            );

            $cards[] = $card;
        }

        return $cards;
    }
}
