<?php

namespace App\Validation;

abstract class FlushValidationAbstract
{
    protected const CORRECT_COUNT = 5;

    protected function isTailValidColor(string $cards, string $firstColor): bool
    {
        return self::CORRECT_COUNT === substr_count($cards, $firstColor);
    }

    protected function removeColorFromCards(string $firstColor, string $cards): string
    {
        return $this->replaceString([$firstColor], $cards);
    }

    protected function removeColorsFromCards(string $cards): string
    {
        return $this->replaceString(['C', 'D', 'H', 'S'], $cards);
    }

    protected function removeSpacing(string $cards): string
    {
        return preg_replace('/\s+/', '', $cards);
    }

    protected function isContainSpecialContent(string $search, string $text): bool
    {
       return preg_match("/\b{$search}\b/", $text);
    }

    private function replaceString(array $search, string $replace): string
    {
        return str_replace(['C', 'D', 'H', 'S'], '', $replace);
    }
}