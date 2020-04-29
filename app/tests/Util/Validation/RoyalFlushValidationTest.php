<?php

namespace App\Tests\Util\Validation;

use App\Validation\RoyalFlushValidation;
use PHPUnit\Framework\TestCase;

class RoyalFlushValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new RoyalFlushValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['10C,JC,QC,KC,AC', true],
            ['10H,JH,QH,KH,AH', true],
            ['AC,JC,QC,10A,AC', false],
        ];
    }
}