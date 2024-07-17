<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FGTAS - Gestão de despesas</title>
</head>
<body>
    <br>
    <center><img src="../img/despesa.png" height="120px"/></center>
    <h1 align="center"> FGTAS - Gestão de despesas </h1>
    <?php
    
    if ( session_status() != PHP_SESSION_ACTIVE){
    session_start();
    }

    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == TRUE){
        require_once('menu.php'); 
    }else{
        header("Location: ../index.php");
    }

    ?><br><br>
</body>
</html>


