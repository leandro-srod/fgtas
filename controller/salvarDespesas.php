<?php

include_once("../dao/clsConexao.php");
include_once("../dao/clsDespesasDAO.php");
include_once("../model/clsDespesas.php");

//INSERIR DESPESA

if(isset($_REQUEST["inserir"])){
    $nome = $_POST["txtNome"];
    if(strlen($nome) == 0 ){
        header("Location: ../despesas.php?nomeVazio");
    }else{
        $novaDesp = new Despesas();
        $novaDesp->nome = $nome;
        DespesasDAO:: inserir($novaDesp);
        header("Location: despesas.php?nome=$nome");
    }
}

// EXCLUIR DESPESA

if(isset($_REQUEST["excluir"]) && isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    DespesasDAO:: excluir($id);
    header("Location: despesas.php?despesaExcluida");
}


// EDITAR DESPESA

if( isset( $_REQUEST["editar"] ) &&  isset( $_REQUEST["id"] ) ){
    $nome = $_POST["txtNome"];
    $id = $_REQUEST["id"];
    DespesasDAO::editar( $nome, $id );
    header( "Location: despesas.php?despesaEditada");
}