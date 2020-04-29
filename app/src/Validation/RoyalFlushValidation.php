<?php

declare(strict_types=1);

namespace App\Validation;

class RoyalFlushValidation extends FlushValidationAbstract implements ValidationInterface
{
    private const CORRECT_ORDER = '10,J,Q,K,A';
    protected const SCORE_VALUE = 10;

    public function checkRules(string $cards): bool
    {
        $cards = $this->removeSpacing($cards);
        $color = $cards[2];

        if ($this->isTailValidColor($cards, $color)) {
            $types = $this->removeColorFromCards($color, $cards);

            return self::CORRECT_ORDER === $types;
        }

        return false;
    }

    public function getName(): string
    {
        return 'Royal Flush';
    }

    public function getScore(): int
    {
        return self::SCORE_VALUE;
    }
}