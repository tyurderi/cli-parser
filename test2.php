<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

require_once __DIR__ . '/cli/PostParser.php';

$result = (new Cli\PostParser)->parse(array_slice($argv, 1));

var_dump($result);
