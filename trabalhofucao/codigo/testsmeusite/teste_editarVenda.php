<?php

require_once "../conexao.php";
require_once "../funcoesdomeusite.php";

$idpedido = 2 ;
$valor_total = 34;
$data_pagamento = "2025-07-15";
$forma_pagamento = "cartão";
$status = "ativo";

editarVenda($conexao, $valor_total, $data_pagamento,$forma_pagamento,$status,$idpedido);