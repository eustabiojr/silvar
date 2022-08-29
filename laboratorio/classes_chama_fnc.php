<?php

use MinhaClasse as GlobalMinhaClasse;

/***********************************************************************************
 * Silvar
 * 
 * Data: 28/08/2022
 ***********************************************************************************/
# 

class MinhaClasse
{
    protected $minhaFuncao;

    public function chama()
    {
        #return "<p>Sou a função 'chama'!</p>" . PHP_EOL;

        $this->minhaFuncao = fn() => 'Funcao anonima';

        return call_user_func($this->minhaFuncao);
    }
    /*
    private function minhaFuncao()
    {
        return "<p>Sou a função usuário!</p>" . PHP_EOL;
    } */
}

//---------------------------------------------------------------
 
$obj1 = new MinhaClasse;
echo $obj1->chama();