<?php 
# 
$y = 1;

$fn1 = fn($x) => $x + $y;

# equivalente usando $y por valor;
$fn2 = function ($x) use ($y) {
    return $x + $y;
};

var_export($fn1(3));
#var_export($fn2(3));