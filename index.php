<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 11/08/2022
 ***********************************************************************************/
# Whoosh

# phpinfo(); 73-98128-0027

// var_dump(getenv('PHP_ENV'), $_SERVER, $_REQUEST);

$metodoSoliciado = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$caminhoSoliciado = $_SERVER['REQUEST_URI'] ?? '/';
echo "<p>O caminho é: <b>" . $caminhoSoliciado . "</b></p>" . PHP_EOL;


if ($metodoSoliciado === 'GET' AND $caminhoSoliciado === '/') {
    print <<<HTML
    <!doctype html>
    <html lang="pt-BR">
        <body>
            Alô Mundo
        </body>
    </html>
HTML;
} else if ($caminhoSoliciado === '/home-antiga') {
    header('Location: /', $substitui = true, $codigo = 301);
    exit;
} else {
    include(__DIR__ . '/inclusoes/404.php');
}
