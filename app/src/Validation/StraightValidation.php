<?php

declare(strict_types=1);

namespace App\Validation;

class StraightValidation extends FlushValidationAbstract implements ValidationInterface
{
    private const CORRECT_ORDER = '4,5,6,7,8,9,10,J,Q,K,A';
    protected const SCORE_VALUE = 5;

    public function checkRules(string $cards): bool
    {
        $cards = $this->removeSpacing($cards);
        $cards = $this->removeColorsFromCards($cards);

        if ($this->isContainSpecialContent($cards, self::CORRECT_ORDER)) {
            return true;
        }

        return false;
    }

    public function getName(): string
    {
        return 'Straight';
    }

    public function getScore(): int
    {
        return self::SCORE_VALUE;
    }

    private function getColorCard(string $cards): string
    {
        return ',' === $cards[2] ? $cards[1] : $cards[2];
    }
}