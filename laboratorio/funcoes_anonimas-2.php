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

/**
 * Closures podem também herdar variáveis do escopo pai. Quaisquer tais variáveis podem ser passadas para 
 * o construtor de linguagem 'use'. Como o PHP 7.1, estas variáveis não devem incluir 'superglobals', $this,
 * ou variáveis com o mesmo nome como parâmetro. Uma declaração tipo retorno para função deve ser colocado
 * após a cláusula 'use'.
 */

# Exemplo #3 Herdando variáveis do escopo pai

$mensagem = 'alo';

// No "use"
#$exemplo = function() /* use ($mensagem) */ {
/*    var_dump($mensagem);
};
$exemplo();*/

// usamos 'use' quando queremmos usar uma variável no closure que esteja fora do contexto do mesmo (ou seja, no contexto pai).
$exemplo = function() use (&$mensagem) {
    var_dump($mensagem);
};
$exemplo(); 

# a variável pode ser herdada por referência. 

# Quando a variável é passada por referência, a alteração do valor no escopo pai é 
# refletida dentro da chamada da função.

// O valor da variável herdada é desde quando a função é definida, [e] não quando chamada
$mensagem = 'mundo';
$exemplo(); 

/*function anexarPessoa($nome) {
    return function ($fazerComando) use ($nome) {
        return sprintf('%s, %s', $nome, $fazerComando);
    };
}

# Encapsula a string 'Clay' na closure
$clay = anexarPessoa('Clay');

# Chama a closure com um comando
echo $clay('me traga um chá doce!'); */
