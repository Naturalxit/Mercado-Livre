<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$valor_total = 100;
$data_pagamento = "2025-06-15";
$forma_pagamento = "cartão";
$status = "ativo";

$idpedido = cadastrarPedido($conexao, $valor_total, $data_pagamento, $forma_pagamento, $status);

echo $idpedido;
