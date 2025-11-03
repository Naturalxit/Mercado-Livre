<?php

require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";



$lista = listarCategoria($conexao);

print_r($lista);
?>