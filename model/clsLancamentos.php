<?php

class Lancamentos{
    public $id;
    public $mes;
    public $credores;
    public $bases;
    public $despesas;
    public $vencimento;
    public $valor_liquido;
    public $multa;
    public $juros;
    public $correcao;
    public $valor_total;

    public function __construct($id = NULL, $mes=NULL, $credores=NULL, $bases=NULL, $despesas=NULL, $vencimento=NULL, 
    $valor_liquido=NULL , $multa=NULL, $juros=NULL, $correcao=NULL, $valor_total=NULL){

        if ($credores == NULL){
         $credores = new Credores ( 0, "Outro");
        }
        
        if ($bases == NULL){
            $bases = new Bases ( 0, "Outra");
        }
        if ($despesas == NULL){
            $despesas = new Despesas ( 0, "Outra");
        }

            $this->id = $id;
            $this->mes = $mes;
            $this->credores = $credores;
            $this->bases = $bases;
            $this->despesas = $despesas;
            $this->vencimento = $vencimento;
            $this->valor_liquido = $valor_liquido;
            $this->multa = $multa;
            $this->juros = $juros;
            $this->correcao = $correcao;
            $this->valor_total = $valor_total;
           
    }

    public function getArrayCSV(){
        $dados = array($this->id , $this->mes , $this->credores->nome , $this->bases->nome , $this->despesas->nome ,
                $this->vencimento , $this->valor_liquido , $this->multa, $this->juros, $this->correcao, $this->valor_total);
        return $dados;

    }

}