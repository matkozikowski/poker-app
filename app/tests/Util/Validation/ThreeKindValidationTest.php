<?php

namespace App\Tests\Util\Validation;

use App\Validation\ThreeKindValidation;
use PHPUnit\Framework\TestCase;

class ThreeKindValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new ThreeKindValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['QC,QC,6C,QC,4C', true],
            ['6H,6D,6C,8H,2S', true],
            ['3C,4C,6C,3A,8C', false],
        ];
    }
}