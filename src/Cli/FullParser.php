<?php

namespace CliParser\Cli;

class FullParser
{

    /**
     * @var PreParser
     */
    protected $preParser  = null;

    /**
     * @var PostParser
     */
    protected $postParser = null;

    public function __construct()
    {
        $this->preParser  = new PreParser();
        $this->postParser = new PostParser();
    }

    public function parse($input)
    {
        $result = $this->preParser->parse($input);
        $result = $this->postParser->parse($result);

        return new Arguments($result);
    }

}