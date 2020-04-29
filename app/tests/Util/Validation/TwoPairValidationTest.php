<?php

namespace App\Tests\Util\Validation;

use App\Validation\TwoPairValidation;
use PHPUnit\Framework\TestCase;

class TwoPairValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new TwoPairValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['KC,KC,QC,QD,3C', true],
            ['QH,QD,10S,10H,2C', true],
            ['2C,4C,6C,3A,8C', false],
        ];
    }
}