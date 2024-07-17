<?php
    session_start();

    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] == false){
        header("Location: index.php");
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
		<title>RELATÓRIOS</title>
	</head>
		
	<body>
		<br>
		
		<?php require_once('menu.php'); ?><br><br><hr>
		
		<h1>Relatório por credores:</h1>  
		<form method="POST" action="relatorio.php?credores">
			
		<input type="radio" value="pdf" name="opcao_relatorio" checked />
		<label>PDF</label>
		<input type="radio" value="csv" name="opcao_relatorio" />
		<label>CSV</label><br>

		<label>Selecione:</label>
            <select name="txtCredores" required>
            <option value="0"> Selecione...</option>
            <?php
                $cred = CredoresDAO::getCredores();
                foreach($cred as $lista){
                    echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
                }
            ?>
        </select>
		<input type="submit" value="Gerar" />
		</form><br><hr>

		<h1>Relatório por Bases Físicas:</h1> 
			<form method="POST" action="relatorio.php?bases"> 

			<input type="radio" value="pdf" name="opcao_relatorio" checked />
		<label>PDF</label>
		<input type="radio" value="csv" name="opcao_relatorio" />
		<label>CSV</label><br>

			<label>Selecione: </label>
            <select name="txtBases" required>
            <option value="0"> Selecione...</option>
	
            <?php
                $bas = BasesDAO::getBases();
                foreach($bas as $lista){
                    echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
                }
            ?>
        </select>
		<input type="submit" value="Gerar" />
       	</form><br><hr>

		
		<h1>Relatório por Despesas:</h1>  
		<form method="POST" action="relatorio.php?despesas">
			
		<input type="radio" value="pdf" name="opcao_relatorio" checked />
		<label>PDF</label>
		<input type="radio" value="csv" name="opcao_relatorio" />
		<label>CSV</label><br>

		<label>Selecione:</label>
            <select name="txtDespesas" required>
            <option value="0"> Selecione...</option>
            <?php
                $desp = DespesasDAO::getDespesas();
                foreach($desp as $lista){
                    echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
                }
            ?>
       		</select>
			<input type="submit" value="Gerar" />
			</form><br><hr>

		<h1>Relatório por Período:</h1> 
		<form method="POST" action="relatorio.php?periodo"> 

		<input type="radio" value="pdf" name="opcao_relatorio" checked />
		<label>PDF</label>
		<input type="radio" value="csv" name="opcao_relatorio" />
		<label>CSV</label><br><br>		

		<label>Período Inicial:</label>
            <input type="date" name="txtInicial" required />
            <br><br> 
			<label>Período Final:</label>
            <input type="date" name="txtFinal" required />
			</select><br><br>

			<input type="submit" value="Gerar" />
       		            
        </form><br><br>

		</body>
		</html>

	<?php
		}
	?>