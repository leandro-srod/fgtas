<?php
    session_start();

    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] == false){
        header("Location: ../index.php");
    }else{
        $id= $_SESSION["idUsuario"];
                   
        include_once ("../model/clsUsuario.php");
        include_once ("../dao/clsUsuarioDAO.php");
        include_once ("../dao/clsConexao.php");
    
        $usuario = UsuarioDAO::getUsuarioById($id);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body><br>
    <?php require_once('menu.php'); ?>
       
    <h1>Editar Usuário:</h1>  

    <form method="POST" action="salvarUsuario.php?editar&id=<?=$id ?>">
    <label>Nome completo:</label>
        <input type="text" value="<?=$usuario->nomeUsuario ?>" name="txtNome" required/>
        <br><br>
    <label>E-mail:</label>
        <input type="text" value="<?=$usuario->emailUsuario ?>" name="txtEmail" required/>
        <br><br>
    <label>Username:</label>
        <input type="text" value="<?=$usuario->loginUsuario ?>" name="txtUsername" required/>
        <br><br>
    <label>Nova Senha:</label>
        <input type="password" placeholder="Insira a senha..." name="txtSenha" />
        <br><br>
    <label>Celular:</label>
         <input type="text" value="<?=$usuario->telefoneCelular ?>" name="txtCelular"/>
         <br><br>
    <input type="submit" value="Salvar Alterações" /><br><br>
    </form>
    
    Deletar conta de usuário:<br>
    <form method="POST" action="salvarUsuario.php?excluir&id=<?=$id ?>">
        <input type="submit" value="Excluir conta" /><br><br>

    </form><br><br>
    <hr>


</body>

</html>

<?php
    }