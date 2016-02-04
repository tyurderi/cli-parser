<?php

require_once __DIR__ . '/vendor/autoload.php';

$parser = new CliParser\Cli\FullParser();
$args   = $parser->parse('say_hello --message="Hello World"');

echo $args->message, PHP_EOL; // echoes Hello World
echo $args->__global__, PHP_EOL; // echoes say_hello