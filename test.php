<?php

require_once __DIR__ . '/vendor/autoload.php';

$parser = new CliParser\Cli\PostParser();
$result = $parser->parse(array_slice($argv, 1));

var_dump($result);