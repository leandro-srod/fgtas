<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FGTAS - Gestão de despesas</title>
</head>
<body>
    <br><center><img src="img/despesa.png" height="120px"/></center>
    <h1 align="center"> Sistema - Gestão de Despesas (v.1.0)</h1>

    <center>
    Login:<br><br>

    <?php

    session_start();
    session_destroy();
    require_once('controller/menu.php'); 
    

    if ( isset($_REQUEST["usuarioInvalido"]) ){
        echo "<script> alert('Login ou senha incorretos!'); </script>";
    }
    

    ?><br><br><br>

    Admin:
    <a href="controller/admin.php" >
    <button>Entrar</button></a><br><br>
    </center>
</body>
</html>


