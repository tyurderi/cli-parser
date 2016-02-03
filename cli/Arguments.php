<?php

namespace CLI;

class Arguments
{

    protected $arguments = array();

    protected $parser    = null;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function parse($input)
    {
        $this->arguments = $this->parser->parse($input);
        $this->prepareArguments();
    }

    public function has($key)
    {
        return isset($this->arguments[$key]);
    }

    public function get($key, $default = false)
    {
        if($this->has($key))
        {
            return $this->arguments[$key];
        }

        return $default;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    protected function prepareArguments()
    {
        $count     = count($this->arguments);
        $arguments = array();

        for($i = 0; $i < $count && $argument = $this->arguments[$i]; $i++)
        {
            if(ltrim($argument, '-') != $argument)
            {
                $key   = ltrim($argument, '-');
                $value = $this->arguments[++$i];

                if(isset($arguments[$key]))
                {
                    if(!is_array($arguments[$key]))
                    {
                        $arguments[$key] = array(
                            $arguments[$key]
                        );
                    }

                    $arguments[$key][] = $value;
                }
                else
                {
                    $arguments[$key] = $value;
                }
            }
            else
            {
                $arguments['undefined'][] = $argument;
            }
        }

        $this->arguments = $arguments;
    }

}