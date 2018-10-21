<?php

namespace Matok\Test\ShuntingYard\PostfixNotation;

use Matok\ShuntingYard\PostfixNotation\Interpreter;
use Matok\ShuntingYard\Token\MinusToken;
use Matok\ShuntingYard\Token\MultiplyToken;
use Matok\ShuntingYard\Token\PlusToken;
use Matok\ShuntingYard\Token\ValueToken;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{
    /**
     * @expectedException \Matok\ShuntingYard\PostfixNotation\Exception\InterpreterException
     */
    public function testGetResultOnEmptyStackThrowsException()
    {
        $interpreter = new Interpreter();

        $interpreter->getResult();
    }

    /**
     * @expectedException \Matok\ShuntingYard\PostfixNotation\Exception\InterpreterException
     */
    public function testMoreThanOneItemsOnStackThrowsException()
    {
        $interpreter = new Interpreter();

        $interpreter->feed(new ValueToken(1));
        $interpreter->feed(new ValueToken(2));

        $interpreter->getResult();
    }

    /**
     * @expectedException \Matok\ShuntingYard\PostfixNotation\Exception\InterpreterException
     */
    public function testNotEnoughValuesOnStackThrowsException()
    {
        $interpreter = new Interpreter();

        $interpreter->feed(new ValueToken(1));
        $interpreter->feed(new PlusToken('+'));

        $interpreter->getResult();
    }

    public function testEvaluateExpression()
    {
        // 5 1 2 + 4 * + 3 −
        $interpreter = new Interpreter();

        $interpreter->feed(new ValueToken(5));
        $interpreter->feed(new ValueToken(1));
        $interpreter->feed(new ValueToken(2));
        $interpreter->feed(new PlusToken('+'));
        $interpreter->feed(new ValueToken(4));
        $interpreter->feed(new MultiplyToken('*'));
        $interpreter->feed(new PlusToken('+'));
        $interpreter->feed(new ValueToken(3));
        $interpreter->feed(new MinusToken('-'));

        $result = $interpreter->getResult();

        $this->assertInstanceOf(ValueToken::class, $result);
        $this->assertEquals(14, $result->value());
    }
}