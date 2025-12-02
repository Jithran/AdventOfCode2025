<?php

function devider($partno) {
    return PHP_EOL . PHP_EOL . str_repeat('=', 30) . ' PART ' . $partno . ' ' . str_repeat('=', 30) . PHP_EOL . PHP_EOL;  
}

function inpread($filename = 'input.txt') {
    return explode("\n", trim(file_get_contents($filename)));
}