<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$idusuario = 1;
$nome = "rogea";
$email = "Rua Fulano";
$senha = "123";
$tipo = "1";

editarUsuario($conexao, $nome, $email, $senha, $tipo);