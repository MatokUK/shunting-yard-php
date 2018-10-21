<?php

namespace Matok\ShuntingYard\Token;

interface TokenInterface
{
    public function isValue(): bool;

    public function isFunction(): bool;

    public function evaluate(ValueToken ...$values): ValueToken;

    public function getOperandsCount(): int;
}