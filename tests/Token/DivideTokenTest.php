<?php

namespace Matok\Test\ShuntingYard\Token;

use Matok\ShuntingYard\Token\DivideToken;
use Matok\ShuntingYard\Token\ValueToken;
use PHPUnit\Framework\TestCase;

class DivideTokenTest extends TestCase
{
    public function testOperandsCount()
    {
        $token = new DivideToken('/');

        $this->assertEquals(2, $token->getOperandsCount());
    }

    /**
     * @dataProvider getEvaluateTests
     */
    public function testEvaluate($a, $b, $expectedResult)
    {
        $token = new DivideToken('/');

        $result = $token->evaluate(new ValueToken($a), new ValueToken($b));

        $this->assertEquals($expectedResult, $result->value());
    }

    public function getEvaluateTests()
    {
        return [
            [1, 2, 0.5],
            [1, -2, -0.5],
            [-1, 2, -0.5],
            [-1, -2, 0.5],
        ];
    }
}