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
    <title>Editar Bases</title>
</head>
<body>

    <br>
    <?php 
    $id= $_GET['id'];
    
    require_once('menu.php');

    include_once ("../model/clsBases.php");
    include_once ("../dao/clsBasesDAO.php");
    include_once ("../dao/clsConexao.php");

    $bases = BasesDAO::getBasesById($id);

    ?>
    
      <h1>Editar Bases Físicas:</h1>  
      
      <form method="POST" action="salvarBases.php?editar&id=<?=$id ?>">
        <label>Nome: </label>
        <input type="text" value="<?=$bases->nome ?>" name="txtNome" />
        <br><br>
        <input type="submit" value="Salvar Alterações" />
    </form>
    <hr>


</body>
</html>
<?php
		}
?>