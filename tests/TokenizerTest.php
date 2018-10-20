<?php

namespace Matok\Test\ShuntingYard;

use Matok\ShuntingYard\Tokenizer;
use Matok\ShuntingYard\TokenInterface;
use PHPUnit\Framework\TestCase;

class TokenizerTest extends TestCase
{
    /**
     * @dataProvider getEmptyTests
     */
    public function testEmptyInput($expression)
    {
        $tokenizer = new Tokenizer($expression);
        $generator = $tokenizer->getTokens();

        $this->assertFalse($generator->valid());
    }

    /**
     * @dataProvider getExpressions
     */
    public function testSimpleExpression($expression)
    {
        $tokenizer = new Tokenizer($expression);

        $tokens = 0;
        foreach ($tokenizer->getTokens() as $token) {
            $this->assertInstanceOf(TokenInterface::class, $token);
            $tokens ++;
        }

        $this->assertEquals(1, $tokens);
    }

    public function testComplexExpression()
    {
        $tokenizer = new Tokenizer('5 + ((1 + 2) * 4) ? 3');

        $tokens = 0;
        foreach ($tokenizer->getTokens() as $token) {
            $tokens ++;
        }

        $this->assertEquals(13, $tokens);
    }

    public function testDigitExpression()
    {
        $tokenizer = new Tokenizer('0 10 20');

        $tokens = 0;
        foreach ($tokenizer->getTokens() as $token) {
            $this->assertEquals(10*$tokens, $token->value());
            $tokens ++;
        }

        $this->assertEquals(3, $tokens);
    }

    public function getEmptyTests()
    {
        return [
            [""],
            [" \n "],
            ["   "],
        ];
    }

    public function getExpressions()
    {
        return [
            ['3'],
            ['34454545'],
            ['+'],
            ['-'],
            ['*'],
            ['/'],
        ];
    }

}