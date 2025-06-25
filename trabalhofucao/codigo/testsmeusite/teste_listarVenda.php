<?php
    require_once "../conexao.php";
    require_once "../funcoesdomeusite.php";

echo "<pre>";
print_r(listarVenda($conexao));
echo "</pre>";

?>