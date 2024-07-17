<?php

include_once("../dao/clsConexao.php");
include_once("../dao/clsBasesDAO.php");
include_once("../model/clsBases.php");

//INSERIR BASE

if(isset($_REQUEST["inserir"])){
    $nome = $_POST["txtNome"];
    if(strlen($nome) == 0 ){
        header("Location: bases.php?nomeVazio");
    }else{
        $novaBa = new Bases();
        $novaBa->nome = $nome;
        BasesDAO:: inserir($novaBa);
        header("Location: bases.php?nome=$nome");
    }
}

// EXCLUIR BASE

if(isset($_REQUEST["excluir"]) && isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    BasesDAO:: excluir($id);
    header("Location: bases.php?baseExcluida");
}


// EDITAR BASE

if( isset( $_REQUEST["editar"] ) &&  isset( $_REQUEST["id"] ) ){
    $nome = $_POST["txtNome"];
    $id = $_REQUEST["id"];
    BasesDAO::editar( $nome, $id );
    header( "Location: bases.php?baseEditada");
}