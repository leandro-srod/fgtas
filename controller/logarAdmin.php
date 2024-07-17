<?php

include_once("../model/clsUsuario.php");
include_once("../dao/clsUsuarioDAO.php");
include_once("../dao/clsConexao.php");

$login = $_POST["txtLogin"];
$senha = $_POST["txtSenha"];
$senha = md5( $senha );
$user = UsuarioDAO::getUsuarioByLoginSenha( $login , $senha );

if($user->loginUsuario == "admin" ) {
	session_start();
	$_SESSION["logado"] = true;
	header("Location: cadastroUsuario.php");
}else{
	header("Location: admin.php?usuarioInvalido");
}