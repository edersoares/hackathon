<?php

class AnalisadorDePagina {

    private $pagina;
    private $dados;

    function __construct(Pagina $pagina) {
        $this->pagina = $pagina;
    }

    public function buscaConteudo() {

        if ($pagina = @file_get_contents($this->pagina->getURL()))
            $this->pagina->setConteudo($pagina);
        else
            return false;

        return true;
    }

    public function analisaConteudo() {

        $tagAbertura = '<tbody>';
        $tagFechamento = '</tbody>';

        $conteudo = $this->pagina->getConteudo();

        $primeiraAbertura = strpos($conteudo, $tagAbertura);
        $segundaAbertura = strpos($conteudo, $tagAbertura, $primeiraAbertura + 1);
        $primeiraFechamento = strpos($conteudo, $tagFechamento);

        $conteudo = substr($conteudo, $segundaAbertura);
        $conteudo = substr($conteudo, 0, strpos($conteudo, $tagFechamento) + strlen($tagFechamento));

        $this->dados = simplexml_load_string($conteudo);
    }

    public function getDados() {
        return $this->dados;
    }

    public function toArray() {

        $xml = $this->getDados();
        $retorno = [];

        foreach ($xml as $tr) {

            foreach ($tr as $td) {

                $item['Entidade'] = (string) $tr->td[0];
                $item['Credor']   = (string) $tr->td[1];
                $item['Cargo']    = (string) $tr->td[2];
                $item['Empenho']  = (string) $tr->td[3];
                $item['Emissão']  = (string) $tr->td[4];
                $item['Valor']    = (string) $tr->td[5];
                $item['Espécie']  = (string) $tr->td[6];

                $retorno[] = $item;
            }
        }

        return $retorno;
    }

}
