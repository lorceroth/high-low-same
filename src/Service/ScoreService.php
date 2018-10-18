<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Model\Score;

class ScoreService
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getScores(): array
    {
        $scores = $this->manager
            ->getRepository(Score::class)
            ->findAll();

        return $scores;
    }

    public function create(
        string $name,
        int $score,
        float $averageDrawTime,
        string $totalTime): Score
    {
        $score = new Score();

        $score->setName($name);
        $score->setScore($score);
        $score->setAverageDrawTime($averageDrawTime);
        $score->setTotalTime($totalTime);
        $score->setPlayedDate(new \DateTime());

        $this->manager->persist($score);
        $this->manager->flush();

        return $score;
    }
}
