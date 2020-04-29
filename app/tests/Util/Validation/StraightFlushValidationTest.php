<?php

namespace App\Tests\Util\Validation;

use App\Validation\StraightFlushValidation;
use PHPUnit\Framework\TestCase;

class StraightFlushValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new StraightFlushValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['4C,5C,6C,7C,8C', true],
            ['5H,6H,7H,8H,9H', true],
            ['4C,5C,6C,7A,8C', false],
        ];
    }
}