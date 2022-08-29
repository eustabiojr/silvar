<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 24/08/2022
 ***********************************************************************************/
#
# Operador de coalescencia nula, adicionado no PHP 7.4

# Comente a linha abaixo e teste
$var = "outro valor";

#$var = $var ?? "padrao";

# Operador de atribuição coalescing null
# pode também ser escrito assim:
$var ??= "padrao";

echo '<pre>' . PHP_EOL;
    var_dump($var);
echo '</pre>' . PHP_EOL;

echo "<p>O retorno é: <b>" . $var . "</b></p>" . PHP_EOL;
