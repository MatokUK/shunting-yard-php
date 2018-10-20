<?php

namespace Matok\ShuntingYard;

class Token implements TokenInterface
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
}