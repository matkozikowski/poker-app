<?php

namespace App\Tests\Util\Validation;

use App\Validation\HighCardValidation;
use PHPUnit\Framework\TestCase;

class HighCardValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new HighCardValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['KC,KC,3C,QC,4C', true],
            ['QH,QD,6C,AH,2S', true],
            ['2C,4C,6C,3A,8C', true],
        ];
    }
}