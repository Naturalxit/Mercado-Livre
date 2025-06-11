<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Vestido Floral";
$tipo = "Roupa";
$estado = "Novo";
$valor = 100;
$estoque = 105;
$descricao = "Vestido Floral";
$status = "Novo";
$categoria = "Moda";

$idproduto = salvarProduto ($nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria);

echo $idproduto;