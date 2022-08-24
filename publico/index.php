<?php
/** ******************************************************************************
 * Index
 * 
 * Data: 21/08/2022
 *********************************************************************************/

#require_once __DIR__ . '/../vender/autoload.php';

#$roteador = new \Estrutura\Roteamento\Roteador();

// esperamos o arquivo rotas para retornar um callable
// ou do contrário esse código  este código quebrará
#$rotas = require_once __DIR__ . '/../aplic/rotas.php';

#$rotas($roteador);

#print $roteador->despacha();
include_once "Fazedor.php";

$obj = include_once 'retorno.php';

$f = new Fazedor;
$var = $obj($f);

#echo "<p>O item 'Um' do array é: <b>" . $arr['um'] . "</b></p>" . PHP_EOL;
#echo "<p>A resposta é: <b>" . $arr() . "</b></p>" . PHP_EOL;
#echo "<p>O resultado é: <b>" . $arr(155) . "</b></p>" . PHP_EOL;

echo '<pre>' . PHP_EOL;
    print_r($var);
echo '</pre>' . PHP_EOL;

