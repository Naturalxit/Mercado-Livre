<?php
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

$id = $_GET['id'];

if (deletarCliente($conexao, $id)) {
    header("Location: listarClientes.php");
} else {
    header("Location: erro.php");
}
?>