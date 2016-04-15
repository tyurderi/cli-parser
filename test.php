<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The full parser is used to parse command line args by string.
 */
$parser = new CLIParser\FullParser();
$args   = $parser->parse('say_hello --message="Hello World"');

echo $args->getFlag('message'), PHP_EOL; // echoes Hello World
echo $args->getArgument(0), PHP_EOL; // echoes say_hello

/**
 * The pre parser is used to generate the same output when you push the arguments throw command line.
 * e.g.: php test.php say_hello --message="Hello World"
 */
$parser = new CLIParser\PreParser();
$args   = $parser->parse('say_hello --message="Hello World"');

var_dump($args);

/**
 * The post parser is used to make out of the pre-parsed arguments usable data.
 * As input can be also used $argv or array_slice($argv, 1)
 */
$parser = new CLIParser\PostParser();
$args   = $parser->parse($args);

/**
 * At least we push our parsed args to CliParser\Cli\Arguments to figure out the best use of it.
 * These three parts will do CliParse\Cli\FullParser at once.
 */
$args = new CLIParser\Arguments($args);
echo $args->getArgument(0), PHP_EOL;