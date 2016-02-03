<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

require_once __DIR__ . '/cli/Parser.php';
require_once __DIR__ . '/cli/Arguments.php';

$parser = new CLI\Parser;
$args   = new CLI\Arguments($parser);
$args->parse(implode(' ', array_slice($argv, 1)));

var_dump($args->getArguments());