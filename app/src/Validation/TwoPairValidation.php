<?php

declare(strict_types=1);

namespace App\Validation;

class TwoPairValidation extends FlushValidationAbstract implements ValidationInterface
{
    protected const EXPECTED_COUNT = 2;
    protected const EXPECTED_COUPLE_SUM = 4;
    protected const SCORE_VALUE = 3;

    public function checkRules(string $cards): bool
    {
        $couple = 0;
        $cards = $this->removeSpacing($cards);

        foreach (explode(',', $cards) as $card) {
            if (self::EXPECTED_COUNT === substr_count($cards, $card[0])) {
                $couple++;
            }
        }

        return $couple === self::EXPECTED_COUPLE_SUM;
    }

    public function getName(): string
    {
        return 'Two pair';
    }

    public function getScore(): int
    {
        return self::SCORE_VALUE;
    }
}