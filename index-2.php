<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 11/08/2022
 ***********************************************************************************/
# Whoosh


# phpinfo();

// var_dump(getenv('PHP_ENV'), $_SERVER, $_REQUEST);

#echo "<br>" . PHP_EOL;

$metodoSoliciado = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$caminhoSoliciado = $_SERVER['REQUEST_URI'] ?? '/';

#echo "<p>O método é: <b>" . $metodoSoliciado . "</b></p>" . PHP_EOL;
#echo "<p>O caminho é: <b>" . $caminhoSoliciado . "</b></p>" . PHP_EOL;
/*
if ($metodoSoliciado === 'GET' AND $caminhoSoliciado === '/') {
    print 'Alô Mundo!';
} else {
    print 'Página de Erro 404';
} */

if ($metodoSoliciado === 'GET' AND $caminhoSoliciado === '/') {
    print <<<HTML
    <!doctype html>
    <html lang="pt-BR">
        <body>
            Alô Mundo
        </body>
    </html>
HTML;
} else {
    include(__DIR__ . '/inclusoes/404.php');
}
