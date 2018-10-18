<?php

namespace App\Tests\Comparer;

use App\Comparer\CardComparer;
use App\Model\Card;
use PHPUnit\Framework\TestCase;

class CardComparerTest extends TestCase
{
    public function testCompare()
    {
        $comparer = new CardComparer();

        $firstCard = new Card();
        $firstCard->setCode('AS');
        $firstCard->setSuit('SPADES');
        $firstCard->setValue('ACE');

        $secondCard = new Card();
        $secondCard->setCode('7H');
        $secondCard->setSuit('HEARTS');
        $secondCard->setValue('7');

        $thirdCard = new Card();
        $thirdCard->setCode('7C');
        $thirdCard->setSuit('CLUBS');
        $thirdCard->setValue('7');

        $emptyCard = new Card();

        $this->assertTrue($comparer->compare($firstCard, $secondCard, 'lower'));
        $this->assertTrue($comparer->compare($secondCard, $thirdCard, 'same'));
        $this->assertTrue($comparer->compare($secondCard, $firstCard, 'higher'));
        $this->assertFalse($comparer->compare($firstCard, $secondCard, 'Somewhere between'));
        $this->assertFalse($comparer->compare($firstCard, $emptyCard, 'same'));
    }
}
