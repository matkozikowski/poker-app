<?php

declare(strict_types=1);

namespace App\Validation;

class FlushValidation extends FlushValidationAbstract implements ValidationInterface
{
    private const EXECUTED_ORDER  = 'A,K,Q,J,10,9,8,7,6,5,4,3,2';
    protected const SCORE_VALUE = 6;

    public function checkRules(string $cards): bool
    {
        $cards = $this->removeSpacing($cards);
        $color = $this->getColorCard($cards);

        $isValidColor = $this->isTailValidColor($cards, $color);

        if (false === $isValidColor) {
            return false;
        }

        $cardsList = explode(',', $this->removeColorFromCards($color, $cards));
        $lastCard = end($cardsList);

        foreach ($cardsList as $key => $card) {
            if ($lastCard === $card) {
                break;
            }

            $nextCard = $cardsList[$key + 1];
            $searchValue = $card . ',' . $nextCard;

            if ($this->isContainSpecialContent($searchValue, self::EXECUTED_ORDER)) {
                return false;
            }
        }

        return true;
    }

    public function getName(): string
    {
        return 'Flush';
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