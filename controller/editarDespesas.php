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
    <title>Editar Despesas</title>
</head>
<body>

    <br>
    <?php 
    $id= $_GET['id'];
    
    require_once('menu.php');

    include_once ("../model/clsDespesas.php");
    include_once ("../dao/clsDespesasDAO.php");
    include_once ("../dao/clsConexao.php");

    $despesas = DespesasDAO::getDespesasById($id);

    ?>
    
      <h1>Editar DESPESAS:</h1>  
      
      <form method="POST" action="salvarDespesas.php?editar&id=<?=$id ?>">
        <label>Nome: </label>
        <input type="text" value="<?=$despesas->nome ?>" name="txtNome" />
        <br><br>
        <input type="submit" value="Salvar Alterações" />
    </form>
    <hr>


</body>
</html>
<?php
}
?>