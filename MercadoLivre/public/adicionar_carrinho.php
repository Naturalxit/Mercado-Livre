<?php
session_start();
require_once "../controle/conexao.php";

// --- detectar variável de conexão válida ---
$db = null;
if (isset($conn) && $conn instanceof mysqli) { 
    $db = $conn; 
} elseif (isset($conexao) && $conexao instanceof mysqli) { 
    $db = $conexao; 
} elseif (isset($mysqli) && $mysqli instanceof mysqli) { 
    $db = $mysqli; 
}

if (!$db) {
    die("Erro: conexão com o banco não encontrada.");
}

// --- verificar se id do produto foi enviado ---
if (!isset($_POST['idproduto'])) {
    header("Location: menuprincipal.php");
    exit;
}

$idproduto = (int) $_POST['idproduto'];

// --- iniciar carrinho ---
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// --- se já existe no carrinho, aumenta quantidade ---
if (isset($_SESSION['carrinho'][$idproduto])) {
    $_SESSION['carrinho'][$idproduto]['quantidade']++;
} else {
    // --- buscar produto ---
    $sql = "SELECT idproduto, nome, valor, foto FROM tb_produto WHERE idproduto = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $idproduto);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    if (!$produto) {
        die("Produto não encontrado.");
    }

    $_SESSION['carrinho'][$idproduto] = [
        'id' => $produto['idproduto'],
        'nome' => $produto['nome'],
        'valor' => $produto['valor'],
        'foto' => $produto['foto'],
        'quantidade' => 1
    ];
}

// --- redirecionar ---
header("Location: carrinho.php");
exit;
?>
