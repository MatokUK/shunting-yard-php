<?php

namespace Matok\ShuntingYard\Token;

class MinusToken extends AbstractTwoOperandToken
{
    public function evaluate(ValueToken ...$values): ValueToken
    {
        return new ValueToken($values[0]->value() - $values[1]->value());
    }
}