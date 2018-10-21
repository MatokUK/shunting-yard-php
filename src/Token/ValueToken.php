<?php

namespace Matok\ShuntingYard\Token;

class ValueToken extends AbstractToken
{
    public function isFunction(): bool
    {
        return false;
    }

    public function evaluate(ValueToken ...$token): ValueToken
    {
        return null;
    }
}