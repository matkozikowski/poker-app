<?php

declare(strict_types=1);

namespace App\Validation;

interface ValidationInterface
{
    public function getName(): string;
    public function checkRules(string $cards): bool;
//    public function getScore(): int;
}