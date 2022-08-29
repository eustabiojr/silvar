<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 11/08/2022
 ***********************************************************************************/
#
# Arrow Function (Função em linha)


/*$var = function($param) { 
    return $param * 3;
};*/

$fator = 3;

$var1 = fn($param) => $param * $fator; // note que não precisamos usa 'use' como quando usamos 'function'

# aqui temos uma função como comum (ou não linha)
$var2 = function($param) use ($fator) {
    return $param * $fator;
};

echo $var2(5);
