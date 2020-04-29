<?php

declare(strict_types=1);

namespace App\Validation;

class StraightFlushValidation extends FlushValidationAbstract implements ValidationInterface
{
    private const CORRECT_ORDER = '4,5,6,7,8,9';
    protected const SCORE_VALUE = 9;

    public function checkRules(string $cards): bool
    {
        $cards = $this->removeSpacing($cards);
        $color = $cards[1];

        if ($this->isTailValidColor($cards, $color)) {
            $types = $this->removeColorFromCards($color, $cards);

            if ($this->isContainSpecialContent($types, self::CORRECT_ORDER)) {
                return true;
            }
        }

        return false;
    }

    public function getName(): string
    {
        return 'Straight Flush';
    }

    public function getScore(): int
    {
        return self::SCORE_VALUE;
    }
}