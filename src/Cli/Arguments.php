<?php

namespace CliParser\Cli;

class Arguments implements \ArrayAccess
{

    protected $arguments = array();

    public function __construct($result)
    {
        $this->arguments = $result;
    }

    public function has($key)
    {
        return $this->offsetExists($key);
    }

    public function get($key)
    {
        return $this->offsetGet($key);
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function offsetGet($offset)
    {
        if($this->offsetExists($offset))
        {
            return $this->arguments[$offset];
        }

        return false;
    }

    public function offsetSet($offset, $value)
    {
        $this->arguments[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if($this->offsetExists($offset))
        {
            unset($this->arguments[$offset]);
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->arguments[$offset]);
    }

}