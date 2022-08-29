<?php 
/***********************************************************************************************
 * Estrutura
 * 
 * Data: 21/08/2022
 ***********************************************************************************************/

namespace Estrutura\Roteamento;

use Exception;
use Throwable;

class Roteador
{
    protected array $rotas = [];
    protected array $manipuladorErros = [];
    protected Rota $corrente;
    
    public function adic(string $metodo, string $caminho, callable $manipulador): Rota {
        $rota = $this->rotas[] = new Rota($metodo, $caminho, $manipulador);

        return $rota;
    }

    public function manipuladorErro(int $codigo, callable $manipulador) 
    {
        $this->manipuladorErros[$codigo] = $manipulador;
    }

    public function despacha()
    {
        $caminhos = $this->caminhos();
       
        $metodoSolicitacao  = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $caminhoSolicitacao = $_SERVER['REQUEST_URI']    ?? '/';

        // isto examina através das rotas definidas e retorna
        // o primeiro que corresponde ao método e caminho
        $correspondecia = $this->corresponde($metodoSolicitacao, $caminhoSolicitacao);

        if ($correspondecia) {
            try {
                // esta ação poderá lançar a exceção 
                // sendo assim, pegamos [a exceção] e mostramos o erro global
                // página que definiremos no arquivo de rotas
                return $correspondecia->despacha();
            } catch (Throwable $e) {
                return $this->despachaErro();
            }
        }

        // se o caminho est definido para um método diferente método
        // podemos exibir uma única página de erro para ele
        if (in_array($caminhoSolicitacao, $caminhos)) {
            return $this->despachaNaoPermitido();
        }
        return $this->despachaNaoEncontrado();
    }

    private function caminhos(): array
    {
        $caminhos = [];

        foreach ($this->rotas as $rota) {
            $caminhos[] = $rota->caminho();
        }
        
        return $caminhos;
    }
    
    public function corrente(): ?Rota 
    {
        return $this->corrente;
    }
    
    private function corresponde(string $metodo, string $caminho): ?Rota
    {
        foreach ($this->rotas as $rota) {
            if ($rota->correspondencias($metodo, $caminho)) {
                return $rota;
            }
        }
        
        return null;
    }

    public function despachaNaoPermitido()
    {
        $this->manipuladorErros[400] ??= fn() => "Não permitido";

        return $this->manipuladorErros[400]();
    }

    public function despachaNaoEncontrado()
    {
        # $this->manipuladorErros[404] = $this->manipuladorErros[404] ? $this->manipuladorErros[404] : fn() => "Não encontrado";
        # $this->manipuladorErros[404] = $this->manipuladorErros[404] ?? fn() => "Não encontrado";
        $this->manipuladorErros[404] ??= fn() => "Não encontrado";

        return $this->manipuladorErros[404]();
    }

    public function despachaErro()
    {
        $this->manipuladorErros[500] ??= fn() => "erro no servidor";
        return $this->manipuladorErros[500]();
    }

    public function redireciona($caminho) 
    {
        header("Location: {$caminho}", $substitui = true, $codigo = 301);
        exit;
    }

}