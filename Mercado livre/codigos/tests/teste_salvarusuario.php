<?php
    require_once "../conexao.php";
    require_once "../funcoes.php";

    $nome = "roger";
    $email = "roger@gmail";
    $senha = "423";
    $tipo = "b";

    salvarUsuario($conexao, $nome, $email, $senha, $tipo);
?>