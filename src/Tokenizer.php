<?php

namespace Matok\ShuntingYard;

use Matok\ShuntingYard\Token\ValueToken;

class Tokenizer
{
    /** @var string */
    private $expression;

    /** @var int */
    private $length;

    public function __construct($expression)
    {
        $this->expression = $expression;
        $this->length = strlen($this->expression);
    }

    public function getTokens()
    {
        $digit = '';
        for ($i = 0; $i < $this->length; $i++) {
            if ($this->isSpaceOnPosition($i)) {
                continue;
            }

            if (!$this->isDigitOnPosition($i)) {
                yield new ValueToken($this->expression[$i]);
            } else {
                $digit .= $this->expression[$i];
                if ($this->isDigitFinished($i)) {
                    yield new ValueToken($digit);
                    $digit = '';
                }
            }
        }
    }

    private function isSpaceOnPosition(int $pos): bool
    {
        return ctype_space($this->expression[$pos]);
    }

    private function isDigitOnPosition(int $pos): bool
    {
        return ctype_digit($this->expression[$pos]);
    }

    private function isDigitFinished(int $pos): bool
    {
        return !isset($this->expression[$pos+1]) || !ctype_digit($this->expression[$pos+1]);
    }
}