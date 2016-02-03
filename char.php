<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

use String\Char;
use String\CharChain;

$chars = new CharChain('Hello');

$chars[4]->remove();

echo $chars->length(), PHP_EOL;
echo $chars, PHP_EOL;
