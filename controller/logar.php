<?php

include_once("../model/clsUsuario.php");
include_once("../dao/clsUsuarioDAO.php");
include_once("../dao/clsConexao.php");

$login = $_POST["txtLogin"];
$senha = $_POST["txtSenha"];
$senha = md5( $senha );
$user = UsuarioDAO::getUsuarioByLoginSenha( $login , $senha );

if( !$user ) {
	header("Location: ../index.php?usuarioInvalido");
}else{
	session_start();
	$_SESSION["logado"] = true;
	$_SESSION["nome"] = $user->nomeUsuario;
	$_SESSION["idUsuario"] = $user->idUsuario;

	header("Location: logado.php");
}