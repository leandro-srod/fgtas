<?php
class Despesas{
    public $id;
    public $nome;

    public function __construct($id_despesas=NULL, $nome_despesas=NULL){
        $this->id= $id_despesas;
        $this->nome=$nome_despesas;
    }

}