<?php

require_once "../../controle/conexao.php";
require_once "../funcoes.php";

$nome = "Teste automatico";
$cpf = "000.000.000-00";
$endereco = "Rua Automatico";
$telefone = "0000-0000";   
$email = "teste@exemplo.com";           
$senha = "senha123";

$idcliente = salvarCliente($conexao, $nome, $cpf, $endereco, $telefone, $email, $senha);

echo $idcliente;