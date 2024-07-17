<?php
class CredoresDAO{

// METODOS ESCREVER BANCO

//INSERIR
    public static function inserir($credores){
        $nome = $credores->nome;
        $sql = "INSERT INTO credores (nome) VALUES ('$nome');";
        $id = Conexao::executarComRetornoId($sql);
        return $id;
    }

//EDITAR
public static function editar( $credores, $id ){
    $id_credores = $id;
    $nome = $credores;
    $sql = "UPDATE credores SET nome = '$nome' WHERE id_credores = $id_credores ;" ;
    Conexao::executar( $sql );
}

//EXCLUIR
    public static function excluir($idCredores){
            $sql = "DELETE FROM credores WHERE id_credores = $idCredores;";
            Conexao::executar($sql);
            }

// METODO CONSULTAR BANCO - Retorna todos CREDORES

    public static function getCredores(){
        $sql = "SELECT id_credores, nome FROM credores ORDER BY nome;";
        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();
        if($result != NULL){
            while(list($_id, $_nome) = mysqli_fetch_row($result)){
                $cred=new Credores();
                $cred->id = $_id;
                $cred->nome = $_nome;
                $lista->append($cred);
                }
         }
         return $lista;
    }

// METODO CONSULTAR BANCO - Retorna CREDORES pelo ID
    public static function getCredoresById($id){
        $sql = "SELECT id_credores , nome FROM credores WHERE id_credores = $id";
        $result = Conexao::consultar( $sql );
        if( $result != NULL ){
            $row = mysqli_fetch_assoc($result);
            if($row){
                $credores = new Credores();
                $credores->nome = $row['nome'];
                return $credores;
            }
        }
        return null;
    }

}