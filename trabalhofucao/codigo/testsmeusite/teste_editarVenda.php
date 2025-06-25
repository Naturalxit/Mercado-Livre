<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$idpedido = 1;
$valor = 100;
$data = 15/06/2025;

editarVenda($conexao, $valor, $data, $idpedido);