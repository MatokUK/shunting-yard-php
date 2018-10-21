<?php

namespace Matok\Test\ShuntingYard\Token;

use Matok\ShuntingYard\Token\PlusToken;
use Matok\ShuntingYard\Token\ValueToken;
use PHPUnit\Framework\TestCase;

class PlusTokenTest extends TestCase
{
    public function testOperandsCount()
    {
        $token = new PlusToken('+');

        $this->assertEquals(2, $token->getOperandsCount());
    }

    /**
     * @dataProvider getEvaluateTests
     */
    public function testEvaluate($a, $b, $expectedResult)
    {
        $token = new PlusToken('+');

        $result = $token->evaluate(new ValueToken($a), new ValueToken($b));

        $this->assertEquals($expectedResult, $result->value());
    }

    public function getEvaluateTests()
    {
        return [
            [0, 0, 0],
            [1, 2, 3],
            [1, -2, -1],
            [-1, 2, 1],
            [-1, -2, -3],
        ];
    }
}