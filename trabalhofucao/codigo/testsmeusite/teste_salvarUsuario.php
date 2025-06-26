<?php
    require_once "../conexao.php";
    require_once "../funcoesdomeusite.php";

    $nome = "roger";
    $email = "roger22@gmail.com";
    $senha = "42234";
    $tipo = "b";

    salvarUsuario($conexao, $nome, $email, $senha, $tipo);


?>
