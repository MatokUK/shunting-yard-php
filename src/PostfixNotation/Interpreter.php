<?php

namespace Matok\ShuntingYard\PostfixNotation;


use Matok\ShuntingYard\PostfixNotation\Exception\InterpreterException;
use Matok\ShuntingYard\Token\TokenInterface;
use Matok\ShuntingYard\Token\ValueToken;

class Interpreter
{
    private $stack = [];

    public function feed(TokenInterface $token)
    {
        if ($token->isValue()) {
            $this->pushToStack($token);
        } else {
            $arguments = $token->getOperandsCount();
            $values = $this->popFromStack($arguments);
            $result = $token->evaluate(...$values);

            $this->pushToStack($result);
        }
    }

    public function getResult(): ValueToken
    {
        if (empty($this->stack) || isset($this->stack[1])) {
            throw new InterpreterException('cannot get result');
        }

        $result = array_pop($this->stack);

        return $result;
    }

    private function pushToStack(TokenInterface $token)
    {
        array_push($this->stack, $token);
    }

    /**
     * @param int $howMuch
     * @throws InterpreterException
     * @return TokenInterface[]
     */
    private function popFromStack(int $howMuch)
    {
        $result = [];

        while ($howMuch-- > 0) {
            $value = array_pop($this->stack);
            if (empty($value)) {
                throw new InterpreterException('There is not enough value tokens on stack!');
            }
            $result[] = $value;
        }

        return array_reverse($result);
    }
}