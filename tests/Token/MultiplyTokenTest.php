<?php

namespace Matok\Test\ShuntingYard\Token;

use Matok\ShuntingYard\Token\MultiplyToken;
use Matok\ShuntingYard\Token\ValueToken;
use PHPUnit\Framework\TestCase;

class MultiplyTokenTest extends TestCase
{
    public function testOperandsCount()
    {
        $token = new MultiplyToken('*');

        $this->assertEquals(2, $token->getOperandsCount());
    }

    /**
     * @dataProvider getEvaluateTests
     */
    public function testEvaluate($a, $b, $expectedResult)
    {
        $token = new MultiplyToken('*');

        $result = $token->evaluate(new ValueToken($a), new ValueToken($b));

        $this->assertEquals($expectedResult, $result->value());
    }

    public function getEvaluateTests()
    {
        return [
            [0, 0, 0],
            [1, 2, 2],
            [1, -2, -2],
            [-1, 2, -2],
            [-1, -2, 2],
        ];
    }
}