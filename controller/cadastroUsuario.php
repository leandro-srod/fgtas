<?php

include_once ("../model/clsUsuario.php");
include_once ("../dao/clsUsuarioDAO.php");
include_once ("../dao/clsConexao.php");

if(isset($_REQUEST["nome"])){
    $nome= $_REQUEST["nome"];
    echo "<script>alert('Usuário $nome cadastrado com sucesso!');window.location.replace('../index.php');</script>"; 
             
}
if(isset($_REQUEST["usuarioExcluido"])){
    echo "<script>alert('Usuário excluído com sucesso!');window.location.replace('../index.php');</script>"; 
}

if(isset($_REQUEST["usuarioExcluidoAdmin"])){
    echo "<script>alert('Usuário excluído com sucesso!');</script>"; 
}

   
if(isset($_REQUEST["usuarioEditado"])){
    echo "<script>alert('Usuário editado com sucesso!');window.location.replace('../index.php');</script>"; 
}

if ( session_status() != PHP_SESSION_ACTIVE){
    session_start();
    }

    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == TRUE){

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO USUÁRIO</title>
</head>
<body>
    <br>
       
      <h1>Cadastrar Usuários:</h1>  

      <form method="POST" action="salvarUsuario.php?inserir">

            <label>Nome completo:</label>
            <input type="text" placeholder="Insira o nome..." name="txtNome" required/>
            <br><br>
            <label>E-mail:</label>
            <input type="text" placeholder="Insira o e-mail..." name="txtEmail" required/>
            <br><br>
            <label>Username:</label>
            <input type="text" placeholder="Insira o username..." name="txtUsername" required/>
            <br><br>
            <label>Senha:</label>
            <input type="password" placeholder="Insira a senha..." name="txtSenha" required/>
            <br><br>
            <label>Celular:</label>
            <input type="text" placeholder="Insira o celular..." name="txtCelular"/>
            <br><br>
            <input type="submit" value="Salvar" />
            <input type="reset" value="Limpar" />
                 
        </form><br><hr>

       Deletar conta de usuário:<br>
         <form method="POST" action="salvarUsuario.php?excluirAdmin">
         
         <select name="txtDelUser" required>
            <option value="0"> Selecione...</option>
            <?php
                $user = UsuarioDAO::getUsuarios();
                foreach($user as $lista){
                    echo '<option value="'.$lista->idUsuario.'">'. $lista->nomeUsuario.'</option>';
                   
                }
            ?>
        </select><br><br>

       <input type="submit" value="Excluir conta" /><br>
        
        </form><br><hr><br>

    <a href="sair.php" ><button>Início</button></a>
    
    </body>
    </html>

    <?php
     }else{
        header("Location: ../index.php");
     }
      
    ?>