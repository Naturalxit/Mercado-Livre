<?php
require_once "verificaLogado.php";
require_once "../controle/conexao.php";

$idusuario = $_SESSION['idusuario'];

// Buscar dados do usuário
$sqlUsuario = "SELECT nome, email, tipo FROM tb_usuario WHERE idusuario = ?";
$stmtUser = $conexao->prepare($sqlUsuario);
$stmtUser->bind_param("i", $idusuario);
$stmtUser->execute();
$resultUsuario = $stmtUser->get_result();
$usuario = $resultUsuario->fetch_assoc();

// Buscar dados do cliente
$sqlCliente = "SELECT * FROM tb_cliente WHERE idusuario = ?";
$stmtCli = $conexao->prepare($sqlCliente);
$stmtCli->bind_param("i", $idusuario);
$stmtCli->execute();
$resultCliente = $stmtCli->get_result();
$cliente = $resultCliente->fetch_assoc();

if (!$cliente) {
    $cliente = [
        'idcliente' => 0,
        'nome' => '',
        'cpf' => '',
        'telefone' => '',
        'endereco' => '',
        'foto' => ''
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Perfil - Clickaê</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/8dcbf7f2b4.js" crossorigin="anonymous"></script>
<style>
body {
    background-color: #f8f9fa;
    padding-top: 70px;
}
.navbar {
    background-color: #fff;
    border-bottom: 1px solid #e0e0e0;
}
.navbar-brand {
    font-weight: 600;
    color: #0d6efd !important;
}
.navbar-nav .nav-link {
    color: #333 !important;
    transition: 0.2s;
}
.navbar-nav .nav-link:hover {
    color: #0d6efd !important;
}
.card {
    border: none;
    border-radius: 15px;
}
footer {
    background: #fff;
    border-top: 1px solid #ddd;
    text-align: center;
    padding: 10px 0;
    margin-top: auto;
}
.btn-warning {
    border-radius: 20px;
}
.btn-primary, .btn-success, .btn-info, .btn-secondary {
    border-radius: 20px;
}
</style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR MESMA COR DO MENU PRINCIPAL -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="menuprincipal.php"><i class="fa-solid fa-hand-pointer"></i> Clickaê</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="menuprincipal.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="carrinho.php">Meus Pedidos</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="deslogar.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTEÚDO -->
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary">Meu Perfil</h2>

    <div class="row justify-content-center align-items-start">
        <div class="col-md-4 text-center mb-4">
            <img src="<?php echo (!empty($cliente['foto'])) ? '../fotos_clientes/'.$cliente['foto'] : 'https://via.placeholder.com/200?text=Perfil'; ?>" 
                 class="rounded-circle img-thumbnail shadow-sm" width="200" height="200" alt="Foto de perfil">
            <p class="mt-3 fw-bold fs-5 text-dark"><?php echo htmlspecialchars($usuario['nome']); ?></p>
        </div>

        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($cliente['nome']); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($cliente['cpf']); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" value="<?php echo !empty($cliente['telefone']) ? htmlspecialchars($cliente['telefone']) : 'Não informado'; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Endereço</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($cliente['endereco']); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Conta</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($usuario['tipo']); ?>" readonly>
                </div>
                <a href="formCliente.php?id=<?php echo $cliente['idcliente']; ?>" class="btn btn-warning w-100 mt-2">
                    <i class="fa-solid fa-pen-to-square"></i> Editar Perfil
                </a>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="formProduto.php" class="btn btn-primary m-2">Cadastrar Produto</a>
        <a href="formCliente.php" class="btn btn-success m-2">Cadastrar Perfil</a>
        <a href="formcategoria.php" class="btn btn-info text-white m-2">Cadastrar Categoria</a>
    </div>

    <div class="text-center mt-4">
        <a href="menuprincipal.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Voltar ao Menu</a>
    </div>
</div>

<footer>
    <p class="mb-0 text-muted">© 2025 - Sistema Clickaê</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
