<?php

namespace Matok\ShuntingYard\PostfixNotation;


use Matok\ShuntingYard\TokenInterface;

class Interpreter
{
    private $stack;

    private $result;

    public function feed(TokenInterface $token)
    {
        if ($token->isValue()) {
            $this->pushToStack($token);
        }

        $arguments = $token->getOperandsCount();
        $values = $this->popFromStack($arguments);
        $result = $token->evaluate($values);

        $this->pushToStack($result);
    }

    public function getResult()
    {
        return $this->result;
    }

    private function pushToStack(TokenInterface $token)
    {
        array_push($this->stack, $token);
    }

    private function popFromStack(int $howMuch)
    {
        $result = [];

        while ($howMuch-- > 0) {
         $result[] = array_pop($this->stack);
        }

        return $result;
    }
}