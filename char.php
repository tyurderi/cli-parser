<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

use String\Char;
use String\CharChain;

$chars = new CharChain('Hello');


echo $chars->length(), PHP_EOL;
echo $chars, PHP_EOL;
