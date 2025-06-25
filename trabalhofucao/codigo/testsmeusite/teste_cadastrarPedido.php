<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$valor_total = 100;
$data = 15/06/2025;


$idcliente = cadastrarPedido($conexao, $valor_total, $data);

echo $idcliente;
