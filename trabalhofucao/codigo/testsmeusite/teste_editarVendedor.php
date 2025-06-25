<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$idcliente = 1;
$nome = "Teste";
$cpf = "111.111.111-11";
$endereco = "Rua Fulano";
$telefone = "62 9 9999-9999";
$email = "teste@gmail.com";
$senha = "123";
$tipo = "vendedor";
$pedido_idpedido = 5;

editarVendedor($conexao, $nome, $cpf, $endereco, $telefone, $email, $senha, $tipo, $pedido_idpedido, $idCliente);