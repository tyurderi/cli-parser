<?php

namespace Cli;

use String\Char;
use String\CharChain;

class PostParser
{

    protected $arguments = array();

    public function parse($input)
    {
        $length    = count($input);

        for($i = 0; $i < $length && $argument = $input[$i]; $i++)
        {
            $chars = new CharChain($argument);
            $char  = $chars[0];

            if($char == '-' && $char->next() != '-')
            {
                $equalsPos = strpos($chars, '=');
                $key       = (string) $char->next();
                $value = substr($chars, $equalsPos === false ? 2 : 3);

                if(empty($value) && isset($input[$i + 1]) && strpos($input[$i + 1], '-') === false)
                {
                    $value = $input[++$i];
                }

                $this->addArgument($key, $value);
            }
            else if($char->is('--'))
            {
                $equalsPos = strpos($chars, '=');
                if($equalsPos === false)
                {
                    $key = substr($chars, 2);
                    $this->addArgument($key, true);
                }
                else
                {
                    $key   = (string) substr($chars,2, $equalsPos - 2);
                    $value = substr($chars, $equalsPos + 1);
                    if(empty($value))
                    {
                        $value = '';
                    }

                    $this->addArgument($key, $value);
                }
            }
        }

        return $this->arguments;
    }

    protected function addArgument($key, $value)
    {
        if(is_numeric($value))
        {
            $value = (int) $value;
        }

        if($value === false)
        {
            $value = '';
        }

        $this->arguments[$key] = $value;
    }
    
}