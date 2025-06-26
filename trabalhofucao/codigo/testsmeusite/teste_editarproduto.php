<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$idproduto = 1;
$nome = "teste";
$tipo = "alimento";
$estado = "bom";
$valor = "30.00";
$estoque = "500"; 
$descricao = "a";
$status = "novo";
$categoria = "comida";

editarProduto($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto);