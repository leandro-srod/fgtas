<?php

include_once("../dao/clsConexao.php");
include_once("../dao/clsUsuarioDAO.php");
include_once("../model/clsUsuario.php");

print_r($_POST);

//INSERIR USUÁRIO

if(isset($_REQUEST["inserir"])){
    
    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    $login = $_POST["txtUsername"];
    $senha = md5($_POST["txtSenha"]);
    $celular = $_POST["txtCelular"];
   
    $novoUser = new Usuario();
    $novoUser->nomeUsuario = $nome;
    $novoUser->emailUsuario = $email;
    $novoUser->loginUsuario = $login;
    $novoUser->senhaUsuario = $senha;
    $novoUser->telefoneCelular = $celular;
    $novoUser->ativo = 'S';

    UsuarioDAO:: inserir($novoUser);
    header("Location: cadastroUsuario.php?nome=$nome");
    }

//EXCLUIR USUÁRIO ADMIN

if(isset($_REQUEST["excluirAdmin"])){
    $user = new Usuario();
    $user->idUsuario = $_POST["txtDelUser"];

    UsuarioDAO:: excluir($user->idUsuario);
    header("Location: cadastroUsuario.php?usuarioExcluidoAdmin");
}

//EXCLUIR USUÁRIO SELF

if(isset($_REQUEST["excluir"]) && isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    UsuarioDAO:: excluir($id);
    header("Location: cadastroUsuario.php?usuarioExcluido");
}

//EDITAR USUÁRIO

if( isset( $_REQUEST["editar"] ) &&  isset( $_REQUEST["id"] ) ){
    
    if (empty($_POST["txtSenha"])){
        $id = $_REQUEST["id"];
        $nome = $_POST["txtNome"];
        $email = $_POST["txtEmail"];
        $login = $_POST["txtUsername"];
        $celular = $_POST["txtCelular"];
        $novoUser = new Usuario();
        $novoUser->nomeUsuario = $nome;
        $novoUser->emailUsuario = $email;
        $novoUser->senhaUsuario = $senha;
        $novoUser->loginUsuario = $login;
        $novoUser->telefoneCelular = $celular;
        $novoUser->ativo = 'S';
    
        UsuarioDAO:: editar($novoUser, $id);
        header("Location: cadastroUsuario.php?usuarioEditado");


    }else{
    $id = $_REQUEST["id"];
    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    $login = $_POST["txtUsername"];
    $senha = md5($_POST["txtSenha"]);
    $celular = $_POST["txtCelular"];
      
    $novoUser = new Usuario();
    $novoUser->nomeUsuario = $nome;
    $novoUser->emailUsuario = $email;
    $novoUser->senhaUsuario = $senha;
    $novoUser->loginUsuario = $login;
    $novoUser->telefoneCelular = $celular;
    $novoUser->ativo = 'S';

    UsuarioDAO:: editar($novoUser, $id);
    header("Location: cadastroUsuario.php?usuarioEditado");
    }
}
