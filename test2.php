<?php

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

require_once __DIR__ . '/cli/PostParser.php';

$input = array(
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

$expected = array(
    'f'         => 'Tommy',
    'l'         => 'Meier',
    'k'         => 5,
    'fn'        => 'Tommy Meier',
    'age'       => 17,
    'company'   => 'Rhinos Media',
    'other'     => '',
    'flag'      => true
);

$result = (new Cli\PostParser)->parse($input);

var_dump($result, $expected == $result);