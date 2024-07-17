<?php
class LancamentosDAO{

// METODOS ESCREVER BANCO

//INSERIR
    public static function inserir($lancamentos){
       
       $mes = $lancamentos->mes;

       $idCredores = $lancamentos->credores->id;
       $idBases = $lancamentos->bases->id;
       $idDespesas = $lancamentos->despesas->id;
                
        $vencimento = $lancamentos->vencimento;
        $valor_liquido = $lancamentos->valor_liquido;
        $multa = $lancamentos->multa;
        $juros = $lancamentos->juros;
        $correcao = $lancamentos->correcao;
        $valor_total = $lancamentos->valor_total;
       
        $sql = "INSERT INTO lancamentos (mes, credores, bases, despesas, vencimento, valor_liquido, multa, juros, correcao, valor_total) 
        VALUES ('$mes', '$idCredores', '$idBases', '$idDespesas', '$vencimento', '$valor_liquido', '$multa', '$juros', '$correcao', '$valor_total');";
        $id = Conexao::executarComRetornoId($sql);
        return $id;
    }

//EDITAR
    public static function editar($mes_lanc, $codCred, $codBases, $despesas_lanc, $vencimento_lanc, $valor_liquido_lanc, 
    $multa_lanc, $juros_lanc, $correcao_lanc, $valor_total_lanc, $id_lanc){
        
        $mes = $mes_lanc;
        $credores = $codCred;
        $bases = $codBases;
        $despesas = $despesas_lanc;
        $vencimento = $vencimento_lanc;
        $valor_liquido = $valor_liquido_lanc;
        $multa = $multa_lanc;
        $juros = $juros_lanc;
        $correcao = $correcao_lanc;
        $valor_total = $valor_total_lanc;
        $id = $id_lanc;

        $sql = "UPDATE lancamentos SET 
                mes = '$mes',
                credores = '$credores',
                bases = '$bases',
                despesas = '$despesas',
                vencimento = '$vencimento',
                valor_liquido = '$valor_liquido',
                multa = '$multa',
                juros = '$juros',
                correcao = '$correcao',
                valor_total = '$valor_total'
     
                WHERE id_lancamentos = $id;" ;
                 Conexao::executar( $sql );
    }


//EXCLUIR
    public static function excluir($idLancamentos){
            $sql = "DELETE FROM lancamentos WHERE id_lancamentos = $idLancamentos;";
            Conexao::executar($sql);
            }

// CONSULTAR LANÇAMENTOS - RETORNA TODOS LANÇAMENTOS
    public static function getLancamentos(){
        $sql = "SELECT l.id_lancamentos, l.mes, DATE_FORMAT(l.vencimento, '%d/%m/%Y') AS vencimento, l.valor_liquido, l.multa, l.juros, 
                    l.correcao, l.valor_total, 
                    c.id_credores AS codCred, c.nome AS nomeCred,
                    b.id_bases AS codBas, b.nome AS nomeBas,
                    d.id_despesas AS codDesp, d.nome AS nomeDesp
            FROM lancamentos l 
            INNER JOIN credores c ON c.id_credores = l.credores 
            INNER JOIN bases b ON b.id_bases = l.bases
            INNER JOIN despesas d ON d.id_despesas = l.despesas
            ORDER BY l.id_lancamentos";

        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();

        if($result != NULL){
            while(list($_id_lancamentos, $_mes, $_vencimento, $_valor_liquido, $_multa, $_juros, $_correcao, $_valor_total, 
            $_codCred, $_nomeCred, $_codBas, $_nomeBas, $_codDesp, $_nomeDesp) = mysqli_fetch_row($result)){
                
            $cred = new Credores();
            $cred->id = $_codCred;
            $cred->nome = $_nomeCred;

            $bas = new Bases();
            $bas->id = $_codBas;
            $bas->nome = $_nomeBas;

            $desp = new Despesas();
            $desp->id = $_codDesp;
            $desp->nome = $_nomeDesp;
              
            $lanc= new Lancamentos();
            $lanc->id=$_id_lancamentos;
            $lanc->mes=$_mes;
            $lanc->vencimento=$_vencimento;
            $lanc->valor_liquido=$_valor_liquido;
            $lanc->multa=$_multa;
            $lanc->juros=$_juros;
            $lanc->correcao=$_correcao;
            $lanc->valor_total=$_valor_total;
            $lanc->credores=$cred;
            $lanc->bases=$bas;
            $lanc->despesas=$desp;    

            $lista->append($lanc);
            }
        }
        return $lista;
    }

    public static function getLancamentosById($id){
        $sql = "SELECT l.mes, l.credores, l.bases, l.despesas, l.vencimento, l.valor_liquido, l.multa, l.juros, l.correcao, l.valor_total
            FROM lancamentos l WHERE l.id_lancamentos = $id";
        
        $result = Conexao::consultar( $sql );
        if( $result != NULL ){
            $row = mysqli_fetch_assoc($result);
            if($row){
                $lanc = new Lancamentos();
                $lanc->mes = $row['mes'];
                $lanc->credores = $row['credores'];
                $lanc->bases = $row['bases'];
                $lanc->despesas = $row['despesas'];
                $lanc->vencimento =$row['vencimento'];
                $lanc->valor_liquido =$row['valor_liquido'];
                $lanc->multa =$row['multa'];
                $lanc->juros =$row['juros'];
                $lanc->correcao =$row['correcao'];
                $lanc->valor_total =$row['valor_total'];
                return $lanc;
            }
        }
    return null;
    }    

// CONSULTAR LANÇAMENTOS POR CREDOR
    public static function getLancamentosbyIdCredor($idcred){
        $sql = "SELECT l.id_lancamentos, l.mes, DATE_FORMAT(l.vencimento, '%d/%m/%Y') AS vencimento, l.valor_liquido, l.multa, l.juros, 
        l.correcao, l.valor_total, 
        c.id_credores AS codCred, c.nome AS nomeCred,
        b.id_bases AS codBas, b.nome AS nomeBas,
        d.id_despesas AS codDesp, d.nome AS nomeDesp
            FROM lancamentos l 
            INNER JOIN credores c ON c.id_credores = l.credores 
            INNER JOIN bases b ON b.id_bases = l.bases
            INNER JOIN despesas d ON d.id_despesas = l.despesas
            WHERE c.id_credores = '$idcred'
            ORDER BY l.id_lancamentos";

        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();

        if($result != NULL){
            while(list($_id_lancamentos, $_mes, $_vencimento, $_valor_liquido, $_multa, $_juros, $_correcao, $_valor_total, 
                $_codCred, $_nomeCred, $_codBas, $_nomeBas, $_codDesp, $_nomeDesp) = mysqli_fetch_row($result)){
                                
                $cred = new Credores();
                $cred->id = $_codCred;
                $cred->nome = $_nomeCred;
                
                $bas = new Bases();
                $bas->id = $_codBas;
                $bas->nome = $_nomeBas;
                
                $desp = new Despesas();
                $desp->id = $_codDesp;
                $desp->nome = $_nomeDesp;
                            
                $lanc= new Lancamentos();
                $lanc->id=$_id_lancamentos;
                $lanc->mes=$_mes;
                $lanc->vencimento=$_vencimento;
                $lanc->valor_liquido=$_valor_liquido;
                $lanc->multa=$_multa;
                $lanc->juros=$_juros;
                $lanc->correcao=$_correcao;
                $lanc->valor_total=$_valor_total;
                $lanc->credores=$cred;
                $lanc->bases=$bas;
                $lanc->despesas=$desp;    
                
                $lista->append($lanc);
            }
        }
    return $lista;
    }

// CONSULTAR LANÇAMENTOS POR BASE
    public static function getLancamentosbyIdBase($idbase){
        $sql = "SELECT l.id_lancamentos, l.mes, DATE_FORMAT(l.vencimento, '%d/%m/%Y') AS vencimento, l.valor_liquido, l.multa, l.juros, 
        l.correcao, l.valor_total, 
        c.id_credores AS codCred, c.nome AS nomeCred,
        b.id_bases AS codBas, b.nome AS nomeBas,
        d.id_despesas AS codDesp, d.nome AS nomeDesp
            FROM lancamentos l 
            INNER JOIN credores c ON c.id_credores = l.credores 
            INNER JOIN bases b ON b.id_bases = l.bases
            INNER JOIN despesas d ON d.id_despesas = l.despesas
            WHERE b.id_bases = '$idbase'
            ORDER BY l.id_lancamentos";

        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();

        if($result != NULL){
            while(list($_id_lancamentos, $_mes, $_vencimento, $_valor_liquido, $_multa, $_juros, $_correcao, $_valor_total, 
            $_codCred, $_nomeCred, $_codBas, $_nomeBas, $_codDesp, $_nomeDesp) = mysqli_fetch_row($result)){
                            
            $cred = new Credores();
            $cred->id = $_codCred;
            $cred->nome = $_nomeCred;
            
            $bas = new Bases();
            $bas->id = $_codBas;
            $bas->nome = $_nomeBas;
            
            $desp = new Despesas();
            $desp->id = $_codDesp;
            $desp->nome = $_nomeDesp;
                          
            $lanc= new Lancamentos();
            $lanc->id=$_id_lancamentos;
            $lanc->mes=$_mes;
            $lanc->vencimento=$_vencimento;
            $lanc->valor_liquido=$_valor_liquido;
            $lanc->multa=$_multa;
            $lanc->juros=$_juros;
            $lanc->correcao=$_correcao;
            $lanc->valor_total=$_valor_total;
            $lanc->credores=$cred;
            $lanc->bases=$bas;
            $lanc->despesas=$desp;    
            
            $lista->append($lanc);
            }
        }
    return $lista;
    }



// CONSULTAR LANÇAMENTOS POR DESPESA
public static function getLancamentosbyIdDespesa($iddespesa){
    $sql = "SELECT l.id_lancamentos, l.mes, DATE_FORMAT(l.vencimento, '%d/%m/%Y') AS vencimento, l.valor_liquido, l.multa, l.juros, 
    l.correcao, l.valor_total, 
    c.id_credores AS codCred, c.nome AS nomeCred,
    b.id_bases AS codBas, b.nome AS nomeBas,
    d.id_despesas AS codDesp, d.nome AS nomeDesp
        FROM lancamentos l 
        INNER JOIN credores c ON c.id_credores = l.credores 
        INNER JOIN bases b ON b.id_bases = l.bases
        INNER JOIN despesas d ON d.id_despesas = l.despesas
        WHERE d.id_despesas = '$iddespesa'
        ORDER BY l.id_lancamentos";

    $result = Conexao::consultar($sql);
    $lista = new ArrayObject();

    if($result != NULL){
        while(list($_id_lancamentos, $_mes, $_vencimento, $_valor_liquido, $_multa, $_juros, $_correcao, $_valor_total, 
        $_codCred, $_nomeCred, $_codBas, $_nomeBas, $_codDesp, $_nomeDesp) = mysqli_fetch_row($result)){
                        
        $cred = new Credores();
        $cred->id = $_codCred;
        $cred->nome = $_nomeCred;
        
        $bas = new Bases();
        $bas->id = $_codBas;
        $bas->nome = $_nomeBas;
        
        $desp = new Despesas();
        $desp->id = $_codDesp;
        $desp->nome = $_nomeDesp;
                      
        $lanc= new Lancamentos();
        $lanc->id=$_id_lancamentos;
        $lanc->mes=$_mes;
        $lanc->vencimento=$_vencimento;
        $lanc->valor_liquido=$_valor_liquido;
        $lanc->multa=$_multa;
        $lanc->juros=$_juros;
        $lanc->correcao=$_correcao;
        $lanc->valor_total=$_valor_total;
        $lanc->credores=$cred;
        $lanc->bases=$bas;
        $lanc->despesas=$desp;    
        
        $lista->append($lanc);
        }
    }
return $lista;
}

// CONSULTAR LANÇAMENTOS POR PERÍODO
    public static function getLancamentosbyPeriodo($inicio, $fim){
    $sql = "SELECT l.id_lancamentos, l.mes, l.vencimento, l.valor_liquido, l.multa, l.juros, 
    l.correcao, l.valor_total, 
    c.id_credores AS codCred, c.nome AS nomeCred,
    b.id_bases AS codBas, b.nome AS nomeBas,
    d.id_despesas AS codDesp, d.nome AS nomeDesp
        FROM lancamentos l 
        INNER JOIN credores c ON c.id_credores = l.credores 
        INNER JOIN bases b ON b.id_bases = l.bases
        INNER JOIN despesas d ON d.id_despesas = l.despesas
        WHERE l.vencimento BETWEEN '$inicio' and '$fim'
        ORDER BY l.vencimento";

    $result = Conexao::consultar($sql);
    $lista = new ArrayObject();

    if($result != NULL){
        while(list($_id_lancamentos, $_mes, $_vencimento, $_valor_liquido, $_multa, $_juros, $_correcao, $_valor_total, 
        $_codCred, $_nomeCred, $_codBas, $_nomeBas, $_codDesp, $_nomeDesp) = mysqli_fetch_row($result)){
                        
        $cred = new Credores();
        $cred->id = $_codCred;
        $cred->nome = $_nomeCred;
        
        $bas = new Bases();
        $bas->id = $_codBas;
        $bas->nome = $_nomeBas;
        
        $desp = new Despesas();
        $desp->id = $_codDesp;
        $desp->nome = $_nomeDesp;
                      
        $lanc= new Lancamentos();
        $lanc->id=$_id_lancamentos;
        $lanc->mes=$_mes;
        $lanc->vencimento=$_vencimento;
        $lanc->valor_liquido=$_valor_liquido;
        $lanc->multa=$_multa;
        $lanc->juros=$_juros;
        $lanc->correcao=$_correcao;
        $lanc->valor_total=$_valor_total;
        $lanc->credores=$cred;
        $lanc->bases=$bas;
        $lanc->despesas=$desp;    
        
        $lista->append($lanc);
        }
    }
return $lista;
}
//Retorna o nome do Credor pelo ID Lançamento
    public static function getCredoresByIdLancamentos($idlancamentos){
   
        $sql = "SELECT  l.credores,
                        c.id_credores, c.nome AS nomeCredor
        from lancamentos l 
        LEFT JOIN credores c ON c.id_credores = l.credores
        WHERE l.id_lancamentos = $idlancamentos";
            
        $result = Conexao::consultar( $sql );
            if( $result != NULL ){
                $row = mysqli_fetch_assoc($result);
                if($row){
                    $credores = new Credores();
                    $credores->nome = $row['nomeCredor'];
                    return $credores;
                }
            }
        return null;
    }

    public static function getBasesByIdLancamentos($idlancamentos){
   
        $sql = "SELECT  l.bases,
                        b.id_bases, b.nome AS nomeBase
        from lancamentos l 
        LEFT JOIN bases b ON b.id_bases = l.bases
        WHERE l.id_lancamentos = $idlancamentos";
            
        $result = Conexao::consultar( $sql );
            if( $result != NULL ){
                $row = mysqli_fetch_assoc($result);
                if($row){
                    $bases = new Bases();
                    $bases->nome = $row['nomeBase'];
                    return $bases;
                }
            }
        return null;
    }

    public static function getDespesasByIdLancamentos($idlancamentos){
   
        $sql = "SELECT  l.despesas,  d.id_despesas, d.nome AS nomeDespesa
                from lancamentos l 
                LEFT JOIN despesas d ON d.id_despesas = l.despesas
                WHERE l.id_lancamentos = $idlancamentos";
            
        $result = Conexao::consultar( $sql );
            if( $result != NULL ){
                $row = mysqli_fetch_assoc($result);
                if($row){
                    $despesas = new Despesas();
                    $despesas->nome = $row['nomeDespesa'];
                    return $despesas;
                }
            }
        return null;
    }


}