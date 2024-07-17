<?php
class Credores{
    public $id;
    public $nome;

    public function __construct($id_credores=NULL, $nome_credores=NULL){
        $this->id= $id_credores;
        $this->nome=$nome_credores;
    }

}