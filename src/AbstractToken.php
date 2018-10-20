<?php

namespace Matok\ShuntingYard;

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

    public function isValue()
    {
        return true;
    }

    public function isFunction()
    {
        return !$this->isValue();
    }
}