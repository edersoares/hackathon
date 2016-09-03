<?php

/*

    Eder
    Diego
    Guilherme
    Alexsander
    Luan

*/

class Pagina {

    private $conteudo;
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function getConteudo() {
        return $this->conteudo;
    }

    public function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    public function getURL() {
        return $this->url;
    }

}
