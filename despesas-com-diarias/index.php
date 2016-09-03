<?php

spl_autoload_register(function($class){
    require_once "{$class}.php";
});

$dados = [];
$i = 1;

while (1) {

    $pagina = new Pagina("http://gravatai.ulbra.tche.br/hackathon/gravatai/diarias/page-{$i}.html");
    $analisador = new AnalisadorDePagina($pagina);

    if ($analisador->buscaConteudo() == false)
        break;

    $analisador->analisaConteudo();
    $dados = array_merge($dados, $analisador->toArray());

    $i++;
}

$total = count($dados);

echo "Foram encontrados {$total} registros.\n";

file_put_contents('arquivos/dados.json', json_encode($dados));
