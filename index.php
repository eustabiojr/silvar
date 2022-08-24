<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 11/08/2022
 ***********************************************************************************/
#
# phpinfo(); 73-98128-0027

#var_dump(getenv('PHP_ENV'), $_SERVER, $_REQUEST);

$metodoSoliciado  = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$caminhoSoliciado = $_SERVER['REQUEST_URI']    ?? '/';

function redirecionaSemprePara($caminho) {
    header("Location: {$caminho}", $substitui = true, $codigo = 301);
    exit;
}

#echo "<p>O caminho é: <b>" . $caminhoSoliciado . "</b></p>" . PHP_EOL;

/**
 * Respondendo com HTML
 */ 
if ($metodoSoliciado === 'GET' AND $caminhoSoliciado === '/' || $caminhoSoliciado === '/index.php' ) {
    print <<<HTML
    <!doctype html>
    <html lang="pt-BR">
        <body>
            Alô Mundo
        </body>
    </html>
HTML;
} else if($caminhoSoliciado === '/home-antiga' || $caminhoSoliciado === '/index.php/home-antiga') {
    #header('Location: /', $substitui = true, $codigo = 301);
    #exit;
    redirecionaSemprePara('/');
} else {
    include(__DIR__ . '/inclusoes/404.php');
}

$rotas = [
    'GET' => [
        '/' => fn() => print
            <<<HTML
            <!doctype html>
            <html lang="pt-BR">
                <body>
                    Alô Mundo
                </body>
            </html>
        HTML,    
        'home-antiga' => fn() => redirecionaSemprePara('/'),   
        'tem-erro-servidor'  => fn() => throw new Exception(),
        'tem-erro-validacao' => fn() => throw aborta(400),
    ],
    'POST' => [],
    'PATCH' => [],
    'PUT' => [],
    'DELETE' => [],
    'HEAD' => [],
    '404' => fn() => include(__DIR__ . '/inclusoes/404.php'),
    '400' => fn() => include(__DIR__ . '/inclusoes/400.php'),
    '500' => fn() => include(__DIR__ . '/inclusoes/500.php'),
];

# dentro de um único array, de forma que podemos ver rapidamente se existe um caminho em algum deles
// into a single array, so we can quickly see if a path exists in any of them
$caminhos = array_merge(
    array_keys($rotas['GET']),
    array_keys($rotas['POST']),
    array_keys($rotas['PATCH']),
    array_keys($rotas['PUT']),
    array_keys($rotas['DELETE']),
    array_keys($rotas['HEAD']),
);

if (isset(
    $rotas[$metodoSoliciado],
    $rotas[$metodoSoliciado][$caminhoSoliciado]
)) {
    $rotas[$metodoSoliciado][$caminhoSoliciado]();
} else if (in_array($caminhoSoliciado, $caminhos)) {
    // o caminho está definido, mas não para este método solicitado;
    // sendo assim, exibimos um erro 400 (que significa uma "requisição ruim")
    $rotas['400'] ();
} else {
    # o caminho não está permitido para nenhum método de solicitação
    // the path isn't allowed for any request method

    # o que provavelmente significa que eles tentaram uma url que o aplicativo não suporta
    // which probably means they tried a url that the application doesn't support
    $rotas['404']();
}

echo '<pre>' . PHP_EOL;
echo "<p><a href=\"outro.php\">Outro</a></p>" . PHP_EOL;
echo "<p><a href=\"funcao_linha.php\">Função em Linha</a></p>" . PHP_EOL;
echo '</pre>' . PHP_EOL;