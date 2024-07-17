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
    <title>EDITAR LANÇAMENTOS</title>
</head>
<body>
<br>

    <?php 
    $id= $_GET['id'];
  
    require_once('menu.php');
    include_once ("../dao/clsConexao.php");

    include_once ("../model/clsCredores.php");
    include_once ("../dao/clsCredoresDAO.php");
 
    include_once ("../model/clsBases.php");
    include_once ("../dao/clsBasesDAO.php");
 
    include_once ("../model/clsDespesas.php");
    include_once ("../dao/clsDespesasDAO.php");
  
    include_once ("../model/clsLancamentos.php");
    include_once ("../dao/clsLancamentosDAO.php");
    
    $lancamento = LancamentosDAO::getLancamentosById($id);
    $credores = LancamentosDAO::getCredoresByIdLancamentos($id);
    $bases = LancamentosDAO::getBasesByIdLancamentos($id);
    $despesas = LancamentosDAO::getDespesasByIdLancamentos($id);
    
    ?>

<br><br>
<form method="POST" action="salvarLancamentos.php?editar&id=<?=$id ?>">
<br>
     <label>Mês:</label>
     <select name="txtMes" required>
         <option value="<?=$lancamento->mes?>"><?=$lancamento->mes?> </option>
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
         <option value="<?=$lancamento->credores?>"><?=$credores->nome ?></option>
         
         <?php
             $cred = CredoresDAO::getCredores();
             foreach($cred as $lista){
                 echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
             }
         ?>
     </select><br><br>

     <label>Bases:</label>
         <select name="txtBases" required>
         <option value="<?=$lancamento->bases ?>"> <?=$bases->nome ?></option>
         <?php
             $bas = BasesDAO::getBases();
             foreach($bas as $lista){
                 echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
             }
         ?>
     </select><br><br>

     <label>Despesas:</label>
         <select name="txtDespesas" required>
         <option value="<?=$lancamento->despesas ?>"> <?=$despesas->nome ?></option>
         <?php
             $desp = DespesasDAO::getDespesas();
             foreach($desp as $lista){
                 echo '<option value="'.$lista->id.'">'. $lista->nome.'</option>';
             }
         ?>
     </select><br><br>
         
     <label>Vencimento:</label>
         <input type="date" name="txtVencimento" value="<?=$lancamento->vencimento ?>" required />
         <br><br>

      <label>Valor Líquido:</label>
         <input type="number" step="0.01" name="txtVLiquido" value="<?=$lancamento->valor_liquido ?>"required />
         <br><br>

     <label>Multa:</label>
         <input type="number" step="0.01" name="txtMulta" value="<?=$lancamento->multa ?>"required/>
         <br><br>

     <label>Juros:</label>
         <input type="number" step="0.01" name="txtJuros" value="<?=$lancamento->juros ?>"required/>
         <br><br>

     <label>Correção:</label>
         <input type="number" step="0.01" name="txtCorrecao" value="<?=$lancamento->correcao ?>"required/>
         <br><br><br>

     <input type="submit" value="Salvar" />
     <input type="reset" value="Limpar" />
         
     </form>

</body>
</html>
<?php
    }

?>