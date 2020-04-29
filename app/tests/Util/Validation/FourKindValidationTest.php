<?php

namespace App\Tests\Util\Validation;

use App\Validation\FourKindValidation;
use PHPUnit\Framework\TestCase;

class FourKindValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new FourKindValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['QC,QC,6C,QC,QC', true],
            ['JH,JH,JH,8H,JH', true],
            ['3C,3C,6C,3A,8C', false],
        ];
    }
}