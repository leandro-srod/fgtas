<?php

include_once("../dao/clsConexao.php");

include_once("../dao/clsLancamentosDAO.php");
include_once("../model/clsLancamentos.php");

include_once("../dao/clsBasesDAO.php");
include_once("../model/clsBases.php");

include_once("../dao/clsCredoresDAO.php");
include_once("../model/clsCredores.php");

include_once("../dao/clsDespesasDAO.php");
include_once("../model/clsDespesas.php");

//INSERIR LANÇAMENTO

if(isset($_REQUEST["inserir"])){
   
        //Criar novo objeto para Credores, Bases e Despesas
        $cred = new Credores();
        $cred->id = $_POST["txtCredores"];
                        
        $bas = new Bases();
        $bas->id = $_POST["txtBases"];
        
        $desp = new Despesas();
        $desp->id = $_POST["txtDespesas"];
        
        $lanc=new Lancamentos();
        $lanc->mes = $_POST["txtMes"];
        $lanc->credores = $cred; 
        $lanc->bases = $bas;
        $lanc->despesas = $desp; 
        $lanc->vencimento = $_POST["txtVencimento"];

        $vLiquido = $_POST["txtVLiquido"];
        $vLiquido = str_replace(",", ".", $vLiquido);
        $lanc->valor_liquido = $vLiquido;

        $multa = $_POST["txtMulta"];
        $lanc->multa = $multa;

        $juros = $_POST["txtJuros"];
        $lanc->juros = $juros;

        $correcao = $_POST["txtCorrecao"];
        $lanc->correcao = $correcao;

        $lanc->valor_total = ($vLiquido+$multa+$juros+$correcao);

        LancamentosDAO:: inserir($lanc);
        header("Location: lancamentos.php?lancamentos");
   // }
}

// EXCLUIR LANÇAMENTO

if(isset($_REQUEST["excluir"]) && isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    LancamentosDAO:: excluir($id);
    header("Location: lancamentos.php?lancamentoExcluido");
}

// EDITAR LANÇAMENTO 

if( isset( $_REQUEST["editar"] ) &&  isset( $_REQUEST["id"] ) ){
    $id = $_REQUEST["id"] ;
    $mes = $_POST['txtMes'];
    $credores = $_POST['txtCredores'];
    $bases = $_POST['txtBases'];
    $despesas = $_POST['txtDespesas'];
    $vencimento = $_POST['txtVencimento'];
    $valor_liquido = $_POST['txtVLiquido'];
    $multa = $_POST['txtMulta'];
    $juros = $_POST['txtJuros'];
    $correcao = $_POST['txtCorrecao'];
    $valor_total = ( $valor_liquido + $multa + $juros = $correcao);

    LancamentosDAO::editar($mes, $credores, $bases, $despesas, $vencimento, $valor_liquido, $multa, $juros, $correcao, $valor_total, $id );
    header( "Location: lancamentos.php?lancamentoEditado");
}
