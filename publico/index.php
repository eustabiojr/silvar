<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 11/08/2022
 ***********************************************************************************/
#

require_once __DIR__ . '/../vendor/autoload.php';

$roteador = new \Estrutura\Roteamento\Roteador();

$rotas = require_once __DIR__ . '/../aplic/rotas.php';
$rotas($roteador);

print $roteador->despacha();