<?php
    session_start();

    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] == false){
        header("Location: ../index.php");
    }else{

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Credores</title>
</head>
<body>

    <br>
    <?php 
    
    $id= $_GET['id'];
    
    require_once('menu.php');

    include_once ("../model/clsCredores.php");
    include_once ("../dao/clsCredoresDAO.php");
    include_once ("../dao/clsConexao.php");

    $credores = CredoresDAO::getCredoresbyId($id);

    ?>
    
      <h1>Editar CREDORES:</h1>  
      
      <form method="POST" action="salvarCredores.php?editar&id=<?=$id ?>">
        <label>Nome: </label>
        <input type="text" value="<?=$credores->nome ?>" name="txtNome" />
        <br><br>
        <input type="submit" value="Salvar Alterações" />
    </form>
    <hr>


</body>
</html>
<?php
    }
?>