<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$idusuario = 1;
$nome = "radaada";
$email = "Rua Fulano";
$senha = "123";
$cpf = "12232";
$endereco = "ruatal";
$foto = "1";
$telefone = "6299232";


editarUsuario($conexao, $nome, $email, $senha, $cpf, $endereco, $foto, $telefone, $idusuario);