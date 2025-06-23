<?php
    require_once "../conexao.php";
    require_once "../funcoesdomeusite.php";

    $nome = "roger";
    $email = "roger@gmail.com";
    $senha = "423";
    $tipo = "b";

    salvarUsuario($conexao, $nome, $email, $senha, $tipo);

    //Eu acho que deu certo, mas no banco não aparece
    
?>
