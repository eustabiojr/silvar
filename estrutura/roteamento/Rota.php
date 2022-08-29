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
    protected array $parametros = [];
    protected ?string $nome = null;

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

    public function parametros(): array
    {
        return $this->parametros;
    }

    public function nome(string $nome = null): string
    {
        if($nome) {
            $this->nome = $nome;
            return $this;
        }

        return $this->nome;
    }
    
    public function correspondencias(string $metodo, string $caminho): bool 
    {
        // se existe uma correspondencia literal então não desperdiçamos
        // mas nenhum tempo tentando corresponder uma expressão regular
        if ($this->metodo === $metodo && $this->caminho === $caminho) {
            return true;
        }

        $nomesParametros = [];

        // o método caminhoNormaliza certifica-se se existe um '/' antes e após o caminho
        // enquanto tambem remove caracteres '/' duplicados
        //
        // exemplos:
        // -> '' => torna-se '/'
        // -> 'inicio' torna-se '/inicio/'
        // -> 'produto/{id}' torna-se '/produto/{id}/'
        $padrao = $this->normalisaCaminho($this->caminho);

        // obtem todos os nomes de parametros e os substitui por sintaxe de expressao regular, 
        // para casar parametros opcionais ou obrigatórios 
        // 
        // exemplos:
        // -> '/inicio/' permanece '/inicio/'
        // -> '/produto/{id}/' permanece '/produto/([^/]+)'
        // -> '/blog/{slug}/' permanece '/produto/([^/]*)(?:/?)'
        $padrao = preg_replace_callback('#{([^]+)}/#', function(array $encontrado) use (& $nomesParametros) {
            array_push(
                $nomesParametros, rtrim($encontrado[1], '?')
            );

            // se nao  um parametro opcional, fazemos a seguinte barra opcional bem como
            if (str_ends_with($encontrado[1], '?')) {
                return '([^/]*)(?:/?)';
            }
            return '([^/]+)/';
            },
            $padrao,
        );

        // se não há parâmetros de roteamento, e ele não foi uma correspondencia literal, então esta rota
        // nunca corresponderá ao caminho solicitado
        if (!str_contains($padrao, '+') && !str_contains($padrao, '*')) {
            return false;
        }

        preg_match_all("#{$padrao}#", $this->normalisaCaminho($caminho), $correspondencias);

        $valoresParametro = [];
        
        if (count($correspondencias[1]) > 0) {
            // se a rota corresponde ao caminho solicitado
            // então precisamos montar os parâmetros antes
            // podemos retornar verdadeiro para a correspondência
            foreach ($correspondencias[1] as $valor) {
                if($valor) {
                    array_push($valoresParametro, $valor);
                    continue;
                }
                array_push($valoresParametro, null);
            }
            
            // tornamos um array vazio de modo que ainda podemos
            // chamar array_combine com parâmetros opcionais
            // os quais podem não ter sido fornecidos
            $valoresVazios = array_fill(0, count($nomesParametros), false);
            
            // a sintaxe += para arrays significa: pegue os valores do lado direito e apenas adicione-os
            // para o lado esquerdo se a mesma chave não já existir.
            //
            // você usualmente não vai querer usar array_merge para combinar arrays,
            // mas este é um uso interessante para +=
            $valoresParametro += $valoresVazios;

            $this->parametros = array_combine($nomesParametros, $valoresParametro);

            return true;
        }

        return false;
    }
    
    private function normalisaCaminho(string $caminho): string
    {
        $caminho = trim($caminho, '/');
        $caminho = "/{$caminho}/";

        // remove múltiplos '/' na linha
        $caminho = preg_replace('/[\/]{2,}/', '/', $caminho);

        return $caminho;
    }
    
    public function despacha()
    {
        return call_user_func($this->manipulador);
    }
}