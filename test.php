<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

require_once __DIR__ . '/cli/Parser.php';
require_once __DIR__ . '/cli/Arguments.php';

$input    = '-fTommy -l Meier --age=17 --gender=male okay --company=Rhinos\ Media';

echo $input, PHP_EOL;

$parser = new CLI\Parser;
$args   = new CLI\Arguments($parser);
$args->parse($input);

var_dump($args->getArguments());