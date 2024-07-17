<?php
class UsuarioDAO{

// METODOS ESCREVER BANCO

//INSERIR
    public static function inserir($user){
        $nome = $user->nomeUsuario;
        $email = $user->emailUsuario;
        $login = $user->loginUsuario;
        $senha = $user->senhaUsuario;
        $cel = $user->telefoneCelular;
        $ativo = $user->ativo;

        $sql = "INSERT INTO usuario (nomeUsuario, emailUsuario, loginUsuario, senhaUsuario, telefoneCelular, ativo) 
                    VALUES ('$nome', '$email', '$login', '$senha', '$cel', '$ativo');";
        $id = Conexao::executarComRetornoId($sql);
        return $id;
    }

    public static function getUsuarioByLoginSenha($login, $senha){
        $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, loginUsuario, telefoneCelular, ativo 
                FROM usuario 
                WHERE loginUsuario = '$login' AND senhaUsuario = '$senha' ";
              
        $result = Conexao::consultar($sql);
            if (mysqli_num_rows($result) == 0){
                return null;
            }else{
                list($_idUsuario, $_nomeUsuario, $_emailUsuario, $_loginUsuario, $_telefoneCelular, $_ativo ) = mysqli_fetch_row($result);
                $user = new Usuario($_idUsuario, $_nomeUsuario, $_emailUsuario, $_loginUsuario, NULL, $_telefoneCelular, $_ativo);
                return $user;
            }
    }

    public static function getUsuarioById($id){
        $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, loginUsuario, senhaUsuario, telefoneCelular, ativo
                 FROM usuario 
                    WHERE idUsuario = $id";
        $result = Conexao::consultar( $sql );
        if( $result != NULL ){
            $row = mysqli_fetch_assoc($result);
            if($row){
                $usuario = new Usuario();
                $usuario->nomeUsuario = $row['nomeUsuario'];
                $usuario->emailUsuario = $row['emailUsuario'];
                $usuario->loginUsuario = $row['loginUsuario'];
                $usuario->senhaUsuario = $row['senhaUsuario'];
                $usuario->telefoneCelular = $row['telefoneCelular'];
                $usuario->ativo = $row['ativo'];
                return $usuario;
            }
        }
        return null;
    }

public static function editar( $userEdit, $id ){
    if(empty($userEdit->senhaUsuario)){
    $id_user = $id;
    $nomeuser = $userEdit->nomeUsuario;
    $emailuser = $userEdit->emailUsuario;
    $loginuser = $userEdit->loginUsuario;
    $teluser = $userEdit->telefoneCelular;
    $ativouser = $userEdit->ativo;
    
    $sql = "UPDATE usuario SET nomeUsuario = '$nomeuser',
                               emailUsuario = '$emailuser',
                               loginUsuario = '$loginuser',
                               telefoneCelular = '$teluser',
                               ativo = '$ativouser'
             WHERE idUsuario = $id ;" ;
    Conexao::executar( $sql );
    }else{
        $id_user = $id;
        $nomeuser = $userEdit->nomeUsuario;
        $emailuser = $userEdit->emailUsuario;
        $loginuser = $userEdit->loginUsuario;
        $senhauser = $userEdit->senhaUsuario;
        $teluser = $userEdit->telefoneCelular;
        $ativouser = $userEdit->ativo;
        
        $sql = "UPDATE usuario SET nomeUsuario = '$nomeuser',
                                   emailUsuario = '$emailuser',
                                   loginUsuario = '$loginuser',
                                   senhaUsuario = '$senhauser',
                                   telefoneCelular = '$teluser',
                                   ativo = '$ativouser'
                 WHERE idUsuario = $id ;" ;
        Conexao::executar( $sql );

    }
}

public static function excluir($idUser){
            $sql = "DELETE FROM usuario WHERE idUsuario = $idUser;";
            Conexao::executar($sql);
            }

// METODO CONSULTAR BANCO - Retorna todos USUÁRIOS
public static function getUsuarios(){
    $sql = "SELECT idUsuario, nomeUsuario FROM usuario ORDER BY nomeUsuario;";
    $result = Conexao::consultar($sql);
    $lista = new ArrayObject();
    
    if($result != NULL){
        while(list($_id, $_nome) = mysqli_fetch_row($result)){
            $user=new Usuario();
            $user->idUsuario = $_id;
            $user->nomeUsuario = $_nome;
            $lista->append($user);
            }
     }
     return $lista;
}

}


