<?php

namespace Matok\ShuntingYard;

interface TokenInterface
{
    public function isValue();

    public function evaluate(array $values);

    public function getOperandsCount();

   // public function getOperandCount();

}