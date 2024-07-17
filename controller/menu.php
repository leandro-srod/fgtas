<?php

if ( session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

if (isset($_SESSION["logado"]) && $_SESSION["logado"] == TRUE){

?>
    Olá <?php echo $_SESSION["nome"]; ?>
    <br><br>

    <a href="credores.php" >
        <button>Credores</button></a>

    <a href="bases.php" >
        <button>Bases</button></a>

    <a href="despesas.php" >
        <button>Despesas</button></a>

    <a href="lancamentos.php" >
        <button>Lançamentos</button></a>

     <a href="editarUsuario.php" >
        <button>Editar Usuário</button></a>
    
    <a href="sair.php" >
        <button>Sair</button></a>

<?php

}else{
?>
    <form action="controller/logar.php" method="POST">
        <input type="text" name="txtLogin" placeholder="Login: " required /><br><br>
        <input type="password" name="txtSenha" placeholder="Senha: " required/><br><br>
        <input type="submit" value="Entrar" />

    </form>

    <?php

}



