<?php
session_start();
require_once "../controle/conexao.php";

// Se o usuário não estiver logado, manda pro login
if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

$idUsuario = $_SESSION['idusuario'];

// Pega o idcliente automaticamente
$sqlCliente = "SELECT idcliente FROM tb_cliente WHERE idusuario = ?";
$stmt = $conn->prepare($sqlCliente);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Cliente não encontrado.");
}

$idCliente = $result->fetch_assoc()['idcliente'];

// Calcula total do carrinho
$sqlCarrinho = "SELECT p.valor FROM tb_cliente_has_tb_produto ch
                JOIN tb_produto p ON p.idproduto = ch.tb_produto_idproduto
                WHERE ch.tb_cliente_idcliente = ?";
$stmt = $conn->prepare($sqlCarrinho);
$stmt->bind_param("i", $idCliente);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
while ($row = $result->fetch_assoc()) {
    $total += $row['valor'];
}

// Insere o pagamento
$sqlPag = "INSERT INTO tb_pagamento (forma_pagamento, pagamento) VALUES ('Cartão', 'Aprovado')";
$conn->query($sqlPag);
$idPagamento = $conn->insert_id;

// Cria o pedido
$sqlPedido = "INSERT INTO tb_pedido (valor_total, tb_cliente_idcliente, tb_pagamento_idtb_pagamento)
              VALUES (?, ?, ?)";
$stmt = $conn->prepare($sqlPedido);
$stmt->bind_param("dii", $total, $idCliente, $idPagamento);
$stmt->execute();

// Limpa o carrinho
$sqlLimpar = "DELETE FROM tb_cliente_has_tb_produto WHERE tb_cliente_idcliente = ?";
$stmt = $conn->prepare($sqlLimpar);
$stmt->bind_param("i", $idCliente);
$stmt->execute();

// Redireciona para página de sucesso
header("Location: sucesso.php");
exit;
?>
