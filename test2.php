<?php

#-fTommy -l Meier --age=17 --company=Rhinos\ Media

require_once __DIR__ . '/string/Char.php';
require_once __DIR__ . '/string/CharChain.php';

use String\Char;
use String\CharChain;

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

function parse($input)
{
    $chars = new CharChain($input);
    $args  = array();

    for($i = 0; $i < $chars->length() && $char = $chars[$i]; $i++)
    {

    }

    return $args;
}

var_dump($expected == parse($input));