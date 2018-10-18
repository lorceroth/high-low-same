<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Score
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=3)
     */
    private $averageDrawTime;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $totalTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $playedDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->name;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getAverageDrawTime(): ?float
    {
        return $this->averageDrawTime;
    }

    public function setAverageDrawTime(float $averageDrawTime): self
    {
        $this->averageDrawTime = $averageDrawTime;

        return $this;
    }

    public function getTotalTime(): ?string
    {
        return $this->totalTime;
    }

    public function setTotalTime(string $totalTime): self
    {
        $this->totalTime = $totalTime;

        return $this;
    }

    public function getPlayedDate(): ?\DateTime
    {
        return $this->playedDate;
    }

    public function setPlayedDate(\DateTime $playedDate): self
    {
        $this->playedDate = $playedDate;

        return $this;
    }
}
