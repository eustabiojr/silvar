<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 24/08/2022
 ***********************************************************************************/
# 
/**
 * Funções anônimas, conhecidas também como closures, permitem a criação de funções que 
 * não tem um nome especificado. Elas são muito proveitosas como o valor de parâmetros callable,
 * mas elas possuem muitos outros usos.
 * 
 * Funções anônimas são implementadas usando a classe Closure.
 */

# Exemplo #1 exemplo função anônima

#echo preg_replace_callback('~-([a-z])~', function($correspondencia) {
    # return strtoupper($correspondencia[1]);
#}, 'alo-mundo');
// saída alo mundo

# Exemplo #2 exemplo atribuição de variável de função anônima
$saldar = function($nome) 
{
    printf("Alo %s\r\n", $nome);
};

$saldar('Mundo');
$saldar('PHP');

#
/*
$closure = function($nome) {
    return sprintf('Alo %s', $nome);
};

echo $closure("Jose"); */