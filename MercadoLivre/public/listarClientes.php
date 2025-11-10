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

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
img.foto-cliente {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
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
<body class="bg-light">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Clientes Cadastrados</h2>
        <a href="formCliente.php" class="btn btn-primary">+ Novo Cliente</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>CPF</th>
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

                            <td><?php echo htmlspecialchars($cliente['nome']); ?></td>

                            <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>

                            <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>

                            <td>
                                <a href="formCliente.php?id=<?php echo $cliente['idcliente']; ?>" class="btn btn-sm btn-warning">
                                    Editar
                                </a>

                                <button class="btn btn-sm btn-danger"
                                onclick="confirmarDeletar(<?php echo $cliente['idcliente']; ?>)">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center text-muted">Nenhum cliente cadastrado.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>
