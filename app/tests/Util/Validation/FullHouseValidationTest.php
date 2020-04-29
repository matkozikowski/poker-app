<?php

namespace App\Tests\Util\Validation;

use App\Validation\FullHouseValidation;
use PHPUnit\Framework\TestCase;

class FullHouseValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new FullHouseValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['10C,10C,10C,JC,JC', true],
            ['8H,8H,8H,QH,QH', true],
            ['6C,6C,6C,3A,QC', false],
        ];
    }
}