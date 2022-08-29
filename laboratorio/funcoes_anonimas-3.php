<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 25/08/2022
 ***********************************************************************************/
# 
/**
 * Funções anônimas, conhecidas também como closures, permitem a criação de funções que 
 * não tem um nome especificado. Elas são muito proveitosas como o valor de parâmetros callable,
 * mas elas possuem muitos outros usos.
 * 
 * Funções anônimas são implementadas usando a classe Closure.
 */

/**
 * Closures podem também herdar variáveis do escopo pai. Quaisquer tais variáveis podem ser passadas para 
 * o construtor de linguagem 'use'. Como o PHP 7.1, estas variáveis não devem incluir 'superglobals', $this,
 * ou variáveis com o mesmo nome como parâmetro. Uma declaração tipo retorno para função deve ser colocado
 * após a cláusula 'use'.
 */

# Exemplo #3 Herdando variáveis do escopo pai

$mensagem = 'mundo';

// Closures podem aceitar também argumentos regulares
$examplo = function ($arg) use ($mensagem) {
    var_dump($arg . ' ' . $mensagem);
};

$examplo("alo");

