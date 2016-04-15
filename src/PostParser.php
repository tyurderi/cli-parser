<?php

namespace CLIParser;

use WCKZ\StringUtil\StaticString;

class PostParser
{

    protected $arguments = array();

    public function parse($input)
    {
        $length = count($input);

        for($i = 0; $i < $length && $argument = $input[$i]; $i++)
        {
            $chars = new StaticString($argument);
            $char  = $chars[0];

            if($char == '-' && $char->next() != '-')
            {
                $key = (string) $char->next();

                if($chars->length() == 2 && (!isset($input[$i + 1]) || $this->isArgument($input, $i + 1)))
                {
                    $this->addArgument($key, true);
                }
                else
                {
                    $key       = (string) $char->next();
                    $equalsPos = strpos($chars, '=');
                    $value     = substr($chars, $equalsPos === false ? 2 : 3);

                    if(empty($value) && $input[$i + 1] && !$this->isArgument($input, $i + 1))
                    {
                        $value = $input[++$i];
                    }

                    $this->addArgument($key, $value);
                }
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
            else
            {
                $this->addArgument('__global__', $argument, true);
            }
        }

        return $this->arguments;
    }

    protected function isArgument($input, $index)
    {
        if(!isset($input[$index]))
        {
            return false;
        }

        $argument = $input[$index];

        return strpos($argument, '-') !== false;
    }

    protected function addArgument($key, $value, $asArray = false)
    {
        if(is_numeric($value))
        {
            $value = (int) $value;
        }

        if($value === false)
        {
            $value = '';
        }

        if($asArray || (isset($this->arguments[$key]) && is_array($this->arguments[$key])))
        {
            $this->arguments[$key][] = $value;
        }
        else if(isset($this->arguments[$key]))
        {
            if(!is_array($this->arguments[$key]))
            {
                $this->arguments[$key] = array(
                    $this->arguments[$key]
                );
            }

            $this->arguments[$key][] = $value;
        }
        else
        {
            $this->arguments[$key] = $value;
        }
    }
    
}