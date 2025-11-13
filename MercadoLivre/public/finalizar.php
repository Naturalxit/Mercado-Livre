<?php
session_start();

// Apaga todos os produtos do carrinho
unset($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Compra Concluída</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column justify-content-center align-items-center vh-100">

    <div class="card text-center shadow p-4" style="max-width: 400px;">
        <div class="card-body">
            <h1 class="text-success mb-3">
                <i class="bi bi-check-circle-fill"></i>
            </h1>
            <h3 class="mb-3">Compra Concluída!</h3>
            <p class="text-muted">Seu pagamento foi processado com sucesso.</p>

            <a href="menuprincipal.php" class="btn btn-primary w-100 mt-3">Voltar ao Menu Principal</a>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.js"></script>
</body>
</html>
