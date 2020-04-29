<?php

declare(strict_types=1);

namespace App\Model;

class HandsDTO
{
    private $cards;

    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function getFirstCards(): array
    {
        return $this->cards[0];
    }

    public function getSecondCards(): array
    {
        return $this->cards[1];
    }
}