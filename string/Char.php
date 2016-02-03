<?php

namespace String;

class Char
{

    protected $charValue = '';

    protected $prev     = null;
    protected $next     = null;

    protected $position = 0;

    public function __construct($charValue = '\0', $position = 0)
    {
        $this->charValue = $charValue;
    }

    public function prev(Char $prev = null)
    {
        if(isset($prev))
        {
            $this->prev = $prev;
        }

        return $this->prev;
    }

    public function next(Char $next = null)
    {
        if(isset($next))
        {
            $this->next = $next;
        }

        return $this->next;
    }

    public function position()
    {
        return $this->position;
    }

    public function __toString()
    {
        return $this->charValue;
    }

    public function match($pattern)
    {
        return preg_match($pattern, $this->charValue);
    }

}