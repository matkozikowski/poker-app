<?php

declare(strict_types=1);

namespace App\Validation;

class HighCardValidation extends FlushValidationAbstract implements ValidationInterface
{
    protected const SCORE_VALUE = 2;

    public function checkRules(string $cards): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'High card';
    }

    public function getScore(): int
    {
        return self::SCORE_VALUE;
    }
}