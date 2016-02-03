<?php

namespace String;

class Char
{

    /**
     * @var string
     */
    protected $charValue = '';

    /**
     * @var Char
     */
    protected $prev     = null;

    /**
     * @var Char
     */
    protected $next     = null;

    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @var CharChain
     */
    protected $chain    = null;

    public function __construct($charValue = '\0', $position = 0, CharChain $chain)
    {
        $this->charValue = $charValue;
        $this->chain     = $chain;
    }

    public function before($charValue)
    {
        $char = new Char($charValue, -1, $this->chain);
        $char->next($this);

        if($this->prev())
        {
            $this->prev()->next($char);
        }

        $this->prev($char);
        $this->chain->rebuild();

        return $char;
    }

    public function after($charValue)
    {
        $char = new Char($charValue, -1, $this->chain);
        $char->prev($this);

        if($this->next())
        {
            $this->next()->prev($char);
        }

        $this->next($char);
        $this->chain->rebuild();

        return $char;
    }

    public function replace($charValue)
    {
        $this->charValue = $charValue;

        $this->chain->rebuild();

        return $this;
    }

    public function remove()
    {
        if($this->prev())
        {
            $this->prev()->next($this->next());
        }

        if($this->next())
        {
            $this->next()->prev($this->prev());
        }

        $this->chain->rebuild();
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

    public function position($position = null)
    {
        if(isset($position))
        {
            $this->position = $position;
        }

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

    public function is($string)
    {
        $length = strlen($string);
        if($length == 1)
        {
            return $string == $this->charValue;
        }

        $buffer = '';
        $char   = $this;
        while($char && $length > 0)
        {
            $buffer .= $char;
            $char    = $char->next();
            $length -= 1;
        }

        return $buffer === $string;
    }

}