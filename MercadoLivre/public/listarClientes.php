<?php
session_start();
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

$clientes = listarClientes($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Clientes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* === Cores e estilo igual ao menu principal === */
body {
    background-color: #0d6efd; /* mesma cor do menu principal */
    color: #fff;
    min-height: 100vh;
}

.container {
    background-color: #ffffff;
    color: #000;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    margin-top: 30px;
}

h2 {
    color: #0d6efd;
}

img.foto-cliente {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
}

.table thead {
    background-color: #0d6efd;
    color: white;
}

.btn-voltar {
    background-color: #6c757d;
    color: white;
    border: none;
}

.btn-voltar:hover {
    background-color: #5a6268;
    color: white;
}

.btn-primary {
    background-color: #0d6efd;
    border: none;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}
</style>

<script>
function confirmarDeletar(id) {
    if (confirm("Tem certeza que deseja deletar este cliente?")) {
        window.location.href = "deletarCliente.php?id=" + id;
    }
}
</script>
</head>

<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Clientes Cadastrados</h2>
        <div>
            <a href="menuprincipal.php" class="btn btn-voltar me-2"> Voltar</a>
            <a href="formCliente.php" class="btn btn-primary">+ Novo Cliente</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($clientes)) : ?>
                        <?php foreach($clientes as $cliente): ?>
                        <tr>
                            <td>
                                <img class="foto-cliente"
                                src="<?php echo (!empty($cliente['foto'])) ? '../fotos_clientes/'.$cliente['foto'] : './img/user.png'; ?>">
                            </td>
                            <td><?php echo htmlspecialchars($cliente['nome'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($cliente['cpf'] ?? ''); ?></td>
                            <td><?php echo !empty($cliente['telefone']) ? htmlspecialchars($cliente['telefone']) : '-'; ?></td>
                            <td><?php echo htmlspecialchars($cliente['endereco'] ?? ''); ?></td>
                            <td>
                                <a href="formCliente.php?id=<?php echo $cliente['idcliente']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <button class="btn btn-sm btn-danger" onclick="confirmarDeletar(<?php echo $cliente['idcliente']; ?>)">Deletar</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center text-muted">Nenhum cliente cadastrado.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
                        