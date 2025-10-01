<?php
require_once "../controle/conexao.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$estoque = $_POST['estoque'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$status = $_POST['status'];
$categoria = $_POST['categoria'];

if ($id == 0) {
    echo "novo";
    $sql = "INSERT INTO tb_produto (nome, descricao, valor, estoque, tipo, estado, status, categoria) VALUES ('$nome', '$descricao', $valor, $estoque, $tipo, $estado, $status, $categoria)";
} else {
    echo "atualizar";
    $sql = "UPDATE tb_produto SET nome = '$nome', descricao = '$descricao', valor = '$valor', estoque = '$estoque', tipo = '$tipo', estado = '$estado', status = '$status', categoria = '$categoria' WHERE idproduto = $id";
}
mysqli_query($conexao, $sql);
