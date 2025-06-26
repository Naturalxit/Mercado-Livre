<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$nome = "Teste automatico";
$tipo = "bebida";
$estado = "bom";
$valor = "20.00";
$estoque = "300";
$descricao = "a";
$status = "novo";
$categoria = "liquido";

$idproduto = cadastrarproduto($conexao, $nome, $tipo, $estado, $valor ,$estoque ,$descricao, $status, $categoria);

echo $idproduto;
