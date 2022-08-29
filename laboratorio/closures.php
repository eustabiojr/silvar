<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 25/08/2022
 ***********************************************************************************/
#
# Closures
#

# Aqui temos um função comum
function MinhaFuncao($param, $funcao) {
    return "X: " . $funcao($param) . PHP_EOL;
}
//------------------------------------------------------------------

# já aqui vemos um função closure
$f = function($p) {
    return $p * 2;
};

echo MinhaFuncao(4, $f);

//------------------------------------------------------------------

# aqui o método classe espera um closure como argumento
class MinhaClasse 
{
    public function carrega(callable $fnc) {
        return $fnc("valor");
    }
}

$mc = new MinhaClasse;
$r = $mc->carrega(function($a) {
    return "<p>R: ". $a . "</p>" . PHP_EOL;
});
# $r2 = $mc->carrega(2); // lança erro, porque o argumento não chamável (ou callable)

echo $r;