<?php
class DespesasDAO{

// METODOS ESCREVER BANCO

//INSERIR
    public static function inserir($despesas){
        $nome = $despesas->nome;
        $sql = "INSERT INTO despesas (nome) VALUES ('$nome');";
        $id = Conexao::executarComRetornoId($sql);
        return $id;
    }

//EDITAR
public static function editar( $despesas, $id ){
    $id_despesas = $id;
    $nome = $despesas;
    $sql = "UPDATE despesas SET nome = '$nome' WHERE id_despesas = $id_despesas ;" ;
    Conexao::executar( $sql );
}

//EXCLUIR
    public static function excluir($idDespesas){
            $sql = "DELETE FROM despesas WHERE id_despesas = $idDespesas;";
            Conexao::executar($sql);
            }

// METODO CONSULTAR BANCO

    public static function getDespesas(){
        //retorna todas as despesas
        $sql = "SELECT id_despesas, nome FROM despesas ORDER BY nome;";
        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();
        if($result != NULL){
            while(list($_id, $_nome) = mysqli_fetch_row($result)){
                $despesas=new Despesas();
                $despesas->id = $_id;
                $despesas->nome = $_nome;
                $lista->append($despesas);
                }
         }
         return $lista;
    }

    public static function getDespesasById($id){
        $sql = "SELECT id_despesas , nome FROM despesas WHERE id_despesas = $id";
        $result = Conexao::consultar( $sql );
        if( $result != NULL ){
            $row = mysqli_fetch_assoc($result);
            if($row){
                $despesas = new Despesas();
                $despesas->nome = $row['nome'];
                return $despesas;
            }
        }
        return null;
    }
}