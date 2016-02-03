<?php

namespace Cli;

use String\Char;
use String\CharChain;

class PreParser
{

    public function parse($input)
    {
        $chars = new CharChain($input);
        $args  = array();

        for($pos = 0; $pos < $chars->length() && $char = $chars[$pos]; $pos++)
        {
            if($buffer = $this->readBuffer($char, $pos))
            {
                $args[] = $buffer;
            }
        }

        return $args;
    }

    protected function readBuffer(Char $char, &$pos)
    {
        $buffer = '';
        $quotes = false;

        while($char && ($char != ' ' || ($char == ' ' && $char->prev() == '\\') || $quotes))
        {
            if($char == '"' && $char->prev() != '\\')
            {
                $quotes = !$quotes;
            }

            $buffer .= $char;
            $char    = $char->next();
        }

        $pos += strlen($buffer);

        $buffer = str_replace('\\ ', ' ', $buffer);

        return $buffer;
    }

}