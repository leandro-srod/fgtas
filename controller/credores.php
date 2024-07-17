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
    <title>CADASTRO CREDORES</title>
</head>
<body>
    <br>
    <?php require_once('menu.php'); ?>
    
      <h1>Cadastrar CREDORES:</h1>  

      <form method="POST" action="salvarCredores.php?inserir">
            <label>Nome:</label>
            <input type="text" placeholder="Insira o nome do credor..." name="txtNome" />
            <br><br>
            <input type="submit" value="Salvar" />
            <input type="reset" value="Limpar" />
        </form>
        <br><hr>

        <?php
            include_once ("../model/clsCredores.php");
            include_once ("../dao/clsCredoresDAO.php");
            include_once ("../dao/clsConexao.php");

            $credores = CredoresDAO::getCredores();

                if(count($credores) == 0){
                    echo "<h1>Nenhum credor cadastrado!</h1>";
                }else{
        ?>
        <table border="2">
        <caption>Credores cadastrados</caption>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>    
            </tr>
            
        <?php
            foreach($credores as $cred){
                $id = $cred->id;
                $nome=$cred->nome;
                echo "  <tr>
                            <td>$id</td>
                            <td>$nome</td>
                            <td><a href='editarCredores.php?id=$id'><button>Editar</button></a></td>
                        
                        <td><a onclick='return confirm(\"Você tem certeza que deseja apagar?\")'
                        href='salvarCredores.php?excluir&id=$id'>
                                <button>Excluir</button></a></td>
                    </tr>";


            }
        ?>
        </table><br><hr><tr>

        <h3>Foram cadastrados <?php echo count($credores)?> credores até
                         <?php date_default_timezone_set("America/Sao_Paulo"); 
                         echo date("d/m/Y")?></h3>                   
        </tr> 

    <?php
    }
        if(isset($_REQUEST["nomeVazio"])){
            echo "<script> alert('O campo nome não pode ser vazio!');</script>";
        }
        if(isset($_REQUEST["nome"])){
            $nome= $_REQUEST["nome"];
            echo "<script>alert('Credor $nome cadastrado com sucesso!');</script>";
        }
        if(isset($_REQUEST["cidadeExcluida"])){
            echo "<script>alert('Credor excluído com sucesso!');</script>";
        }
        if(isset($_REQUEST["credorEditado"])){
            echo "<script>alert('Credor editado com sucesso!');</script>";
        }
    ?>

</body>
</html>

<?php

    }

    