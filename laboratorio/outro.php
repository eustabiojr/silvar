<?php
/**
 * Outro
 * 
 * Visa testar chaves de arrays e verificar se possuem alguma valor definido.
 */

 $indice_solicitado = 'algo';

$itens = array(
    'fruta' => [ 'morango' => ['cor' => 'vermelho']],
    'animal' => [ 'elefante' => 'verde'],
    'planta' => [ 'algo' => 'XXX'],
    'cores' => []
);

$indices = array_merge(
    array_keys($itens['fruta']), // aqui pegamos o sub-array que tem como índice a palavra 'fruta'
    array_keys($itens['animal']),
    array_keys($itens['planta']),
    array_keys($itens['cores'])
);

# imprimindo array
#print_r($itens);
print_r($indices);

// caso o 'indice solicitado' exista no array (que pegamos as chaves) '$indice' ecoamos positivo.
if(in_array($indice_solicitado, $indices)) {
    echo "<p>O índice solicitado existe no array!</p>" . PHP_EOL;
} else {
    echo "<p>O índice solicitado NÃO existe no array!</p>" . PHP_EOL;
}

if(isset($itens['fruta'])) {
    echo "<p>A variável está definida!</p>" . PHP_EOL;
}