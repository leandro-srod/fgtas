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
    <title>CADASTRO BASES</title>
</head>
<body>
    <br>
    <?php require_once('menu.php'); ?>
    
      <h1>Cadastrar BASES FÍSICAS:</h1>  

      <form method="POST" action="salvarBases.php?inserir">
            <label>Nome:</label>
            <input type="text" placeholder="Insira o nome da base..." name="txtNome" />
            <br><br>
            <input type="submit" value="Salvar" />
            <input type="reset" value="Limpar" />
        </form>
        <br><hr>

        <?php
            include_once ("../model/clsBases.php");
            include_once ("../dao/clsBasesDAO.php");
            include_once ("../dao/clsConexao.php");

            $bases = BasesDAO::getBases();

                if(count($bases) == 0){
                    echo "<h1>Nenhuma base cadastrada!</h1>";
                }else{
        ?>
        <table border="2">
        <caption>Bases cadastradas</caption>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>    
            </tr>
            
        <?php
            foreach($bases as $ba){
                $id = $ba->id;
                $nome=$ba->nome;
                echo "  <tr>
                            <td>$id</td>
                            <td>$nome</td>
                            <td><a href='editarBases.php?id=$id'><button>Editar</button></a></td>
                        
                        <td><a onclick='return confirm(\"Você tem certeza que deseja apagar?\")'
                        href='salvarBases.php?excluir&id=$id'>
                                <button>Excluir</button></a></td>
                    </tr>";


            }
        ?>
        </table><br><hr><tr>
        
        <h3>Foram cadastradas <?php echo count($bases)?> bases até
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
            echo "<script>alert('Base $nome cadastrada com sucesso!');</script>";
        }
        if(isset($_REQUEST["BaseExcluida"])){
            echo "<script>alert('Base excluída com sucesso!');</script>";
        }
        if(isset($_REQUEST["baseEditada"])){
            echo "<script>alert('Base editada com sucesso!');</script>";
        }
    ?>

</body>
</html>

<?php

    }

    