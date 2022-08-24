<?php 
/********************************************************************************************
* Estrutura
* 
* Data: 21/08/2022
********************************************************************************************/

use Estrutura\Roteamento\Roteador;

return function(Roteador $roteador) {
    $roteador->adic(
        'GET', '/',
        fn() => 'alo mundo',
    );

    $roteador->adic(
        'GET', '/home-antiga',
        fn() => $roteador->redireciona('/'),
    );

    $roteador->adic(
        'GET', '/tem-erro-servidor',
        fn() => throw new Exception(),
    );

    $roteador->adic(
        'GET', '/tem-erro-validacao',
        fn() => $roteador->despachaNaoPermitido(),
    );

    $roteador->manipuladorErro(404, fn() => 'silvar!');

    $roteador->adic(
        'GET', '/produtos/visao/{produto}',
        function() use ($roteador) {
            $parametros = $roteador->corrente()->parametros();
            return "produto é {$parametros['produot']}";
        },
    );

    $roteador->adic(
        'GET', '/servicos/visao/{servico}',
        function() use ($roteador) {
            $parametros = $roteador->corrente()->parametros();
            
            if(empty($parametros['servico'])) {
                return 'todos os serviços';
            }

            return "serviço é {$parametros['servico']}";
        },
    );
};