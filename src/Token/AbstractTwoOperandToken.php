<?php

namespace Matok\ShuntingYard\Token;

abstract class AbstractTwoOperandToken extends AbstractToken
{
    final public function isFunction(): bool
    {
        return true;
    }

    final public function getOperandsCount(): int
    {
        return 2;
    }
}