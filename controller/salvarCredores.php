<?php

include_once("../dao/clsConexao.php");
include_once("../dao/clsCredoresDAO.php");
include_once("../model/clsCredores.php");

//INSERIR CREDOR

if(isset($_REQUEST["inserir"])){
    $nome = $_POST["txtNome"];
    if(strlen($nome) == 0 ){
        header("Location: credores.php?nomeVazio");
    }else{
        $novoCred = new Credores();
        $novoCred->nome = $nome;
        CredoresDAO:: inserir($novoCred);
        header("Location: credores.php?nome=$nome");
    }
}

// EXCLUIR CREDOR

if(isset($_REQUEST["excluir"]) && isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    CredoresDAO:: excluir($id);
    header("Location: credores.php?credorExcluido");
}


// EDITAR CREDOR

if( isset( $_REQUEST["editar"] ) &&  isset( $_REQUEST["id"] ) ){
    $nome = $_POST["txtNome"];
    $id = $_REQUEST["id"];
    CredoresDAO::editar( $nome, $id );
    header( "Location: credores.php?credorEditado");
}