<?php

declare(strict_types=1);

namespace App\Validation;

class FullHouseValidation extends FlushValidationAbstract implements ValidationInterface
{
    private const EXPECTED_COUNT = 3;
    private const EXPECTED_COUPLE = 2;
    protected const SCORE_VALUE = 7;

    public function checkRules(string $cards): bool
    {
        $figures = false;
        $couple = false;
        $cards = $this->removeSpacing($cards);

        foreach (explode(',', $cards) as $card) {
            if (self::EXPECTED_COUNT === substr_count($cards, $card[0])) {
                $figures = true;
            }

            if (self::EXPECTED_COUPLE === substr_count($cards, $card[0])) {
                $couple = true;
            }
        }

        return $couple && $figures;
    }

    public function getName(): string
    {
        return 'Full House';
    }

    public function getScore(): int
    {
        return self::SCORE_VALUE;
    }
}