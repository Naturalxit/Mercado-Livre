<?php
session_start();

// pega os parâmetros da URL
$idcliente = $_GET['idcliente'] ?? null;
$idusuario = $_GET['idusuario'] ?? null;

if (!$idcliente || !$idusuario) {
    die("Erro: dados não encontrados.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Realizado</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 30px; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 400px; margin: auto; }
        h1 { font-size: 20px; color: #333; }
        p { font-size: 16px; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; background: #007bff; color: #fff; padding: 10px 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Cadastro realizado com sucesso!</h1>
        <p><strong>ID do Cliente:</strong> <?= htmlspecialchars($idcliente) ?></p>
        <p><strong>ID do Usuário:</strong> <?= htmlspecialchars($idusuario) ?></p>
        <a href="listarClientes.php">Ver todos os clientes</a>
    </div>
</body>
</html>
