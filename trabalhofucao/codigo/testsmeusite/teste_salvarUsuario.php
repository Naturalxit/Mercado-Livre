<?php
    require_once "../conexao.php";
    require_once "../funcoesdomeusite.php";

    $nome = "roger";
    $email = "roger22@gmail.com";
    $senha = "42234";
    $cpf = "87783";
    $endereco = "rua seila";
    $foto ="1";
    $telefone ="4232";


    salvarUsuario($conexao, $nome, $email, $senha, $cpf,$endereco,$foto,$telefone);


?>
