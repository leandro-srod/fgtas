<?php
class Bases{
    public $id;
    public $nome;

    public function __construct($id_bases=NULL, $nome_bases=NULL){
        $this->id= $id_bases;
        $this->nome=$nome_bases;
    }

}