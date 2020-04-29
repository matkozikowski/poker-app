<?php

namespace App\Tests\Util\Validation;

use App\Validation\StraightValidation;
use PHPUnit\Framework\TestCase;

class StraightValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new StraightValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['4C,5C,6C,7C,8C', true],
            ['5C,6H,7C,8H,9H', true],
            ['3C,5C,6C,7D,8C', false],
        ];
    }
}