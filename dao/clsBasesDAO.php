<?php
class BasesDAO{

// METODOS ESCREVER BANCO

//INSERIR
    public static function inserir($bases){
        $nome = $bases->nome;
        $sql = "INSERT INTO bases (nome) VALUES ('$nome');";
        $id = Conexao::executarComRetornoId($sql);
        return $id;
    }

//EDITAR
public static function editar( $bases, $id ){
    $id_bases = $id;
    $nome = $bases;
    $sql = "UPDATE bases SET nome = '$nome' WHERE id_bases = $id_bases ;" ;
    Conexao::executar( $sql );
}

//EXCLUIR
    public static function excluir($idBases){
            $sql = "DELETE FROM bases WHERE id_bases = $idBases;";
            Conexao::executar($sql);
            }

// METODO CONSULTAR BANCO

    public static function getBases(){
        //retorna todas as bases
        $sql = "SELECT id_bases, nome FROM bases ORDER BY nome;";
        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();
        if($result != NULL){
            while(list($_id, $_nome) = mysqli_fetch_row($result)){
                $bases=new Bases();
                $bases->id = $_id;
                $bases->nome = $_nome;
                $lista->append($bases);
                }
         }
         return $lista;
    }

    public static function getBasesById($id){
        $sql = "SELECT id_bases , nome FROM bases WHERE id_bases = $id";
        $result = Conexao::consultar( $sql );
        if( $result != NULL ){
            $row = mysqli_fetch_assoc($result);
            if($row){
                $bases = new Bases();
                $bases->nome = $row['nome'];
                return $bases;
            }
        }
        return null;
    }
}