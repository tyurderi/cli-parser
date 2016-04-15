<?php

namespace CLIParser;

use WCKZ\StringUtil;

class PreParser
{

    public function parse($input)
    {
        $chars = new StringUtil\MutateableString($input);
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

    protected function readBuffer(StringUtil\StaticChar $char, &$pos)
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

        $buffer = $this->removeChars($buffer, '\\');
        $buffer = $this->removeChars($buffer, '"');

        return $buffer;
    }

    protected function removeChars($subject, $needle)
    {
        $chars = new StringUtil\MutateableString($subject);

        while($pos = strpos($chars, $needle))
        {
            $char = $chars[$pos];
            if($char->prev() && $char->prev() != '\\' || !$char->prev())
            {
                $char->remove();
            }
        }

        return (string) $chars;
    }

}