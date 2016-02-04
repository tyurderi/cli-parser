<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

require_once __DIR__ . '/cli/PreParser.php';

$input = '-fTommy -l Meier -k=5 --fn="Tommy Meier" --age=17 --company=Rhinos\ Media --other= --flag';
$expected = array(
    '-fTommy',
    '-l',
    'Meier',
    '-k=5',
    '--fn=Tommy Meier',
    '--age=17',
    '--company=Rhinos Media',
    '--other=',
    '--flag'
);

$result = (new Cli\PreParser)->parse($input);

var_dump($result, $expected == $result);