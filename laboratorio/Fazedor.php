<?php
/**
 * Retorno usando return
 * 
 * Data: 21/08/2022
 ****************************************************************************************/

/**
 * Classe Fazedor
 */
class Fazedor 
{
    protected array $algo = [];

    public function adic(string $coisa, string $tipo) {
        $r = $this->algo[] = array('coisa' => $coisa, 'tipo' => $tipo);

        return $r;
    }
}