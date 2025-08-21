<?php

require_once "../../controle/conexao.php";
require_once "../funcoes.php";

$idusuario = 1;
$email = "alguem@gmail.com";
$senha = "12345";
$tipo = "vendedor";

editarCliente($conexao, $email, $senha, $tipo, $idusuario);