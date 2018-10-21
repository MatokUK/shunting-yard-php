<?php

namespace Matok\ShuntingYard\Token;

abstract class AbstractToken implements TokenInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function value()
    {
        return $this->data;
    }

    public function getOperandsCount(): int
    {
        return 0;
    }

    final public function isValue(): bool
    {
        return !$this->isFunction();
    }
}