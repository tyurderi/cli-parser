<?php

namespace CLI;

use String\CharChain;
use String\Char;

class Parser
{

    protected $args = array();

    public function parse($input)
    {
        if(is_array($input))
        {
            $input = implode(' ', $input);
        }

        $chars = new CharChain($input);

        for($pos = 0; $chars->length() && $char = $chars[$pos]; $pos++)
        {
            if ($char == '-' && $char->next() != '-' && $char->prev() != '-')
            {
                $this->args[] = $chars->sub($pos, 2);
                $pos         += 1;
                $char         = $char->next()->next();

                if(!$char) {
                    $this->args[] = true;
                    continue;
                }

                if($char == ' ')
                {
                    $pos++;
                    continue;
                }
            }
            else if($char == '-' && $char->next() == '-')
            {
                $buffer = '';
                while($char && $char != '=' && $char != ' ')
                {
                    $buffer .= $char;
                    $char    = $char->next();
                }

                $this->args[] = $buffer;
                $pos         += strlen($buffer);

                if(!$char) {
                    $this->args[] = true;
                    continue;
                }

                $char = $char->next();
                $pos += 1;

                if(!$char) {
                    $this->args[] = '';
                    continue;
                }
            }

            if($buffer = $this->readBuffer($char, $pos))
            {
                $this->args[] = $buffer;
            }
        }

        return $this->args;
    }

    protected function readBuffer(Char $char, &$pos)
    {
        $buffer = '';
        $quotes = false;
        while($char && ($char != ' ' || ($char == ' ' && $char->prev() == '\\') || ($char == ' ' && $quotes)))
        {
            if($char == '"' && $char->prev() != '\\' && !$quotes)
            {
                $quotes = true;
            }
            else if($char == '"' && $char->prev() != '\\' && $quotes)
            {
                $quotes = false;
            }

            $buffer .= $char;
            $char    = $char->next();
        }

        $pos += strlen($buffer);

        $buffer = trim($buffer, '"');
        $buffer = str_replace('\\ ', ' ', $buffer);

        return $buffer;
    }

}