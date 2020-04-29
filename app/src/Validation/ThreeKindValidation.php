<?php

declare(strict_types=1);

namespace App\Validation;

class ThreeKindValidation extends FlushValidationAbstract implements ValidationInterface
{
    protected const EXPECTED_COUNT = 3;
    protected const SCORE_VALUE = 4;

    public function checkRules(string $cards): bool
    {
        $cards = $this->removeSpacing($cards);

        foreach (explode(',', $cards) as $card) {
            if (self::EXPECTED_COUNT === substr_count($cards, $card[0])) {
                return true;
            }
        }

        return false;
    }

    public function getName(): string
    {
        return 'Three of a kind';
    }

    public function getScore(): int
    {
        return self::SCORE_VALUE;
    }
}