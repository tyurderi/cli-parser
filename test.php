<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

require_once __DIR__ . '/cli/ParserInterface.php';
require_once __DIR__ . '/cli/FullParser.php';
require_once __DIR__ . '/cli/CliParser.php';
require_once __DIR__ . '/cli/Arguments.php';


$args   = new CLI\Arguments(CLI\Arguments::PARSER_CLI);
$args->parse($argv);

var_dump($args->getArguments());