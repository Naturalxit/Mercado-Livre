<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$nome = "Teste automatico";
$cpf = "000.000.000-00";
$endereco = "Rua Automatico";
$telefone = "991234568";
$foto = //;

$idcliente = salvarCliente($conexao, $nome, $cpf, $endereco, $telefone, $foto);

echo $idcliente;
