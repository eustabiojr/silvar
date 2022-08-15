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
        'home-antiga' => fn() => 
        redirecionaSemprePara('/'),   
    ],
    'POST' => [],
    'PATCH' => [],
    'PUT' => [],
    'DELETE' => [],
    'HEAD' => [],
    '404' => fn() => include(__DIR__ . '/inclusoes/404.php'),
    '400' => fn() => include(__DIR__ . '/inclusoes/400.php'),
];

$caminhos = array_merge(
    array_keys($rotas['GET']),
    array_keys($rotas['POST'])
);

# ALGUNS TESTES MEUS AQUI
$arr = [
    'PINTAR' => ['x' => 15],
    'COLORIR' => [],
    'APAGAR' => []
];

print_r(array_keys($arr['COLORIR']));