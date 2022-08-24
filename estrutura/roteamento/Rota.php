<?php 
/***********************************************************************************************
 * Estrutura
 * 
 * Data: 21/08/2022
 ***********************************************************************************************/

namespace Estrutura\Roteamento;

class Rota
{
    protected string $metodo;
    protected string $caminho;
    protected $manipulador;

    public function __construct(string $metodo, string $caminho, callable $manipulador)
    {
       $this->metodo      = $metodo; 
       $this->caminho     = $caminho; 
       $this->manipulador = $manipulador; 
    }

    public function metodo(string $metodo): string
    {
        return $this->metodo;
    }

    public function caminho(string $caminho): string
    {
        return $this->caminho;
    }

    public function correspondencias(string $metodo, string $caminho): bool{
        return $this->metodo === $metodo && $this->caminho === $caminho;
    }

    public function despacha()
    {
        return call_user_func($this->manipulador);
    }
}