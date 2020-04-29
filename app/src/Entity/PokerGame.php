<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="poker_game")
 * @ORM\Entity(repositoryClass="App\Repository\PokerGameRepository")
 */
class PokerGame
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="cards_first")
     */
    private $cardsFirst;

    /**
     * @ORM\Column(type="string", length=255, name="cards_second")
     */
    private $cardsSecond;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardsFirst(): ?string
    {
        return $this->cardsFirst;
    }

    public function setCardsFirst(string $cardsFirst): self
    {
        $this->cardsFirst = $cardsFirst;

        return $this;
    }

    public function getCardsSecond(): ?string
    {
        return $this->cardsSecond;
    }

    public function setCardsSecond(string $cardsSecond): self
    {
        $this->cardsSecond = $cardsSecond;

        return $this;
    }

    public function getCards(): array
    {
        return [
            $this->getCardsFirst(),
            $this->getCardsSecond(),
        ];
    }
}
