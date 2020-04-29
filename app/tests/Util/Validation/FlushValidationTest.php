<?php

namespace App\Tests\Util\Validation;

use App\Validation\FlushValidation;
use PHPUnit\Framework\TestCase;

class FlushValidationTest extends TestCase
{
    /**
     * @dataProvider getCardsData
     */
    public function testCorrectCheckRules($cards, $expected): void
    {
        $royalFlushValidation = new FlushValidation();

        $this->assertEquals($expected, $royalFlushValidation->checkRules($cards));
    }

    public function getCardsData(): array
    {
        return [
            ['QC,KC,JC,8C,9C', true],
            ['KH,QH,JH,10H,9H', false],
            ['3C,3C,6C,3A,8C', false],
        ];
    }
}