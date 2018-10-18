<?php

namespace App\Comparer;

use App\Model\Card;

class CardComparer
{
    const LOWER_CHOICE = 'lower';
    const SAME_CHOICE = 'same';
    const HIGHER_CHOICE = 'higher';

    public function compare(Card $firstCard, Card $secondCard, string $choice): bool
    {
        switch ($choice) {
            case self::LOWER_CHOICE:
                return $firstCard->isLower($secondCard);
                break;
            case self::SAME_CHOICE:
                return $firstCard->isSame($secondCard);
                break;
            case self::HIGHER_CHOICE:
                return $firstCard->isHigher($secondCard);
                break;
        }

        return false;
    }
}
