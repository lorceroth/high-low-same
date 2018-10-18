<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Deck
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $remaining;

    /**
     * @var Card[]|ArrayCollection
     */
    private $cards;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getRemaining(): ?int
    {
        return $this->remaining;
    }

    public function setRemaining(int $remaining): self
    {
        $this->remaining = $remaining;

        return $this;
    }

    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function getFirstCard(): Card
    {
        return $this->cards->first();
    }

    public function addCards(array $cards): self
    {
        foreach ($cards as $card) {
            $this->addCard($card);
        }

        return $this;
    }

    public function addCard(Card $card): self
    {
        $this->cards->add($card);

        return $this;
    }
}
