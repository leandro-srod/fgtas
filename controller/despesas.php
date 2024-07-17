<?php
    session_start();

    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] == false){
        header("Location: index.php");
    }else{

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DESPESAS</title>
</head>
<body>
    <br>
    <?php require_once('menu.php'); ?>
    
      <h1>Cadastrar DESPESAS:</h1>  

      <form method="POST" action="salvarDespesas.php?inserir">
            <label>Nome:</label>
            <input type="text" placeholder="Insira o nome da despesa..." name="txtNome" />
            <br><br>
            <input type="submit" value="Salvar" />
            <input type="reset" value="Limpar" />
        </form>
        <br><hr>

        <?php
            include_once ("../model/clsDespesas.php");
            include_once ("../dao/clsDespesasDAO.php");
            include_once ("../dao/clsConexao.php");

            $despesas = DespesasDAO::getDespesas();

                if(count($despesas) == 0){
                    echo "<h1>Nenhuma despesa cadastrada!</h1>";
                }else{
        ?>
        <table border="2">
        <caption>Despesas cadastradas</caption>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>    
            </tr>
            
        <?php
            foreach($despesas as $desp){
                $id = $desp->id;
                $nome=$desp->nome;
                echo "  <tr>
                            <td>$id</td>
                            <td>$nome</td>
                            <td><a href='editarDespesas.php?id=$id'><button>Editar</button></a></td>
                        
                        <td><a onclick='return confirm(\"Você tem certeza que deseja apagar?\")'
                        href='salvarDespesas.php?excluir&id=$id'>
                                <button>Excluir</button></a></td>
                    </tr>";


            }
        ?>
        </table><br><hr><tr>
        
        <h3>Foram cadastradas <?php echo count($despesas)?> despesas até
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
            echo "<script>alert('Despesa $nome cadastrada com sucesso!');</script>";
        }
        if(isset($_REQUEST["despesaExcluida"])){
            echo "<script>alert('Despesa excluída com sucesso!');</script>";
        }
        if(isset($_REQUEST["despesaEditada"])){
            echo "<script>alert('Despesa editada com sucesso!');</script>";
        }
    ?>
</body>
</html>

<?php

    }

    