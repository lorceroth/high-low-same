<?php

namespace App\Model;

class Card
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $suit;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $image;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getSuit(): ?string
    {
        return $this->suit;
    }

    public function setSuit(string $suit): self
    {
        $this->suit = $suit;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getValueAsInt(): ?int
    {
        $value = $this->value;

        switch ($value) {
            case 'ACE':
                $value = 1;
                break;
            case '0':
                $value = 10;
                break;
            case 'JACK':
                $value = 11;
                break;
            case 'QUEEN':
                $value = 12;
                break;
            case 'KING':
                $value = 13;
                break;
        }

        return (int)$value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isLower(Card $card): bool
    {
        $value = $this->getValueAsInt();
        $otherValue = $card->getValueAsInt();

        return $value < $otherValue;
    }

    public function isSame(Card $card): bool
    {
        $value = $this->getValueAsInt();
        $otherValue = $card->getValueAsInt();

        return $value === $otherValue;
    }

    public function isHigher(Card $card): bool
    {
        $value = $this->getValueAsInt();
        $otherValue = $card->getValueAsInt();

        return $value > $otherValue;
    }
}
