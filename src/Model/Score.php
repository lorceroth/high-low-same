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
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $draws;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $averageDrawTime;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $totalTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDraws(): ?int
    {
        return $this->draws;
    }

    public function setDraws(int $draws): self
    {
        $this->draws = $draws;

        return $this;
    }

    public function getAverageDrawTime(): ?string
    {
        return $this->averageDrawTime;
    }

    public function setAverageDrawTime(string $averageDrawTime): self
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
