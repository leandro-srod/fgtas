<?php

    session_start();

    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] == false){
        header("Location: ../index.php");
    }else{


   include_once ("../dao/clsConexao.php");

   include_once ("../model/clsCredores.php");
   include_once ("../dao/clsCredoresDAO.php");

   include_once ("../model/clsBases.php");
   include_once ("../dao/clsBasesDAO.php");

   include_once ("../model/clsDespesas.php");
   include_once ("../dao/clsDespesasDAO.php");
 
   include_once ("../model/clsLancamentos.php");
   include_once ("../dao/clsLancamentosDAO.php");
   
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LANÇAMENTOS</title>
</head>

<body>
    <br>
    <?php require_once('menu.php'); ?>

      <h1>Cadastrar LANÇAMENTOS:</h1>  
      <form method="POST" action="salvarLancamentos.php?inserir">
     
        <label>Mês:</label>
        <select name="txtMes" required>
	        <option>Escolha o mês</option>
	        <option value="Janeiro">Janeiro</option>
	        <option value="Fevereiro">Fevereiro</option>
	        <option value="Março">Março</option>
	        <option value="Abril">Abril</option>
	        <option value="Maio">Maio</option>
	        <option value="Junho">Junho</option>
	        <option value="Julho">Julho</option>
	        <option value="Agosto">Agosto</option>
	        <option value="Setembro">Setembro</option>
	        <option value="Outubro">Outubro</option>
	        <option value="Novembro">Novembro</option>
	        <option value="Dezembro">Dezembro</option>
        </select><br><br>

        <label>Credores:</label>
            <select name="txtCredores" required>
            <option value="0"> Selecione...</option>
            <?php
                $cred = CredoresDAO::getCredores();
                foreach($cred as $lista){
                    echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
                }
            ?>
        </select><br><br>

        <label>Bases:</label>
            <select name="txtBases" required>
            <option value="0"> Selecione...</option>
            <?php
                $bas = BasesDAO::getBases();
                foreach($bas as $lista){
                    echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
                }
            ?>
        </select><br><br>

        <label>Despesas:</label>
            <select name="txtDespesas" required>
            <option value="0"> Selecione...</option>
            <?php
                $desp = DespesasDAO::getDespesas();
                foreach($desp as $lista){
                    echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
                }
            ?>
        </select><br><br>
            
        <label>Vencimento:</label>
            <input type="date" name="txtVencimento" required />
            <br><br>

         <label>Valor Líquido:</label>
            <input type="number" step="0.01" name="txtVLiquido" required />
            <br><br>

        <label>Multa:</label>
            <input type="number" step="0.01" name="txtMulta" required/>
            <br><br>

        <label>Juros:</label>
            <input type="number" step="0.01" name="txtJuros" required/>
            <br><br>

        <label>Correção:</label>
            <input type="number" step="0.01" name="txtCorrecao" required/>
            <br><br>

        <input type="submit" value="Salvar" />
        <input type="reset" value="Limpar" />
            
        </form><br><hr>

    <?php

         // LISTAR LANÇAMENTOS

         $lanc = LancamentosDAO::getLancamentos();
               if(count($lanc) == 0){
                    echo "<h2>Nenhum lançamento cadastrado!</h2>";
                }else{
        ?>

        <table border="2">
        <caption>Lançamentos cadastrados</caption>
            <tr>
                <th>Código</th>
                <th>Mês</th>
                <th>Credor</th>
                <th>Base Física</th>
                <th>Despesa</th>
                <th>Vencimento</th>
                <th>Valor Líquido</th>
                <th>Multa</th>
                <th>Juros</th>
                <th>Correção</th>
                <th>Valor Total</th>
                <th>Editar</th>
                <th>Excluir</th>    
            </tr>

        <?php
            foreach($lanc as $lancamentos){
                $idlanc = $lancamentos->id;
                       
            echo "  <tr>
                            <td>$idlanc</td>
                            <td>".$lancamentos->mes."</td>
                            <td>".$lancamentos->credores->nome."</td>
                            <td>".$lancamentos->bases->nome."</td>
                            <td>".$lancamentos->despesas->nome."</td>
                            <td>".$lancamentos->vencimento."</td>
                            <td>".$lancamentos->valor_liquido."</td>
                            <td>".$lancamentos->multa."</td>
                            <td>".$lancamentos->juros."</td>
                            <td>".$lancamentos->correcao."</td>
                            <td>".$lancamentos->valor_total."</td>

                            <td><a href='editarLancamentos.php?id=$idlanc'><button>Editar</button></a></td>
                           
                            <td><a onclick='return confirm(\"Você tem certeza que deseja apagar?\")' 
                            href='salvarLancamentos.php?excluir&id=$idlanc'>
                                <button>Excluir</button></a></td>
                        </tr>";

            }
        ?>
        </table>
        <tr>
            <h3>Foram cadastrados <?php echo count($lanc)?> lançamentos até
                         <?php date_default_timezone_set("America/Sao_Paulo"); 
                         echo date("d/m/Y")?></h3>                   
        </tr><hr>

    <?php
    }
       
        if(isset($_REQUEST["lancamentos"])){
            echo "<script>alert('Lançamento cadastrado com sucesso!');</script>";
        }
        if(isset($_REQUEST["lancamentoExcluido"])){
            echo "<script>alert('Lançamento excluído com sucesso!');</script>";
        }

        if(isset($_REQUEST["lancamentoEditado"])){
            echo "<script>alert('Lançamento editado com sucesso!');</script>";
        }


    ?>

<a href="relatorioLancamentos.php" target="_blanck">Gerar relatório</a>

</body>
</html>

<?php
    }