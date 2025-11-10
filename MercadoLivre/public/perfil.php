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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4 text-center">Meu Perfil</h2>

    <div class="row justify-content-center">

        <!-- FOTO -->
        <div class="col-md-4 text-center">
            <img src="<?php echo (!empty($cliente['foto'])) ? '../fotos_clientes/'.$cliente['foto'] : 'https://via.placeholder.com/200?text=Perfil'; ?>" 
                 class="rounded-circle img-thumbnail" width="200" height="200">
            <p class="mt-2 fw-bold fs-5"><?php echo $usuario['nome']; ?></p>
        </div>

        <!-- INFO -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">

                <div class="mb-3">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" value="<?php echo $cliente['nome']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" value="<?php echo $cliente['cpf']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" value="<?php echo $cliente['telefone']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Endereço</label>
                    <input type="text" class="form-control" value="<?php echo $cliente['endereco']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Conta</label>
                    <input type="text" class="form-control" value="<?php echo $usuario['tipo']; ?>" readonly>
                </div>

                <a href="formCliente.php?id=<?php echo $cliente['idcliente']; ?>" class="btn btn-warning w-100">
                    Editar Perfil
                </a>

            </div>
        </div>
    </div>

    <!-- BOTÕES -->
    <div class="text-center mt-5">
        <a href="formProduto.php" class="btn btn-primary btn-lg m-2">Cadastrar Produto</a>
        <a href="formCliente.php" class="btn btn-success btn-lg m-2">Cadastrar Perfil</a>
        <a href="formcategoria.php" class="btn btn-info btn-lg m-2 text-white">Cadastrar Categoria</a>
    </div>

    <div class="text-center mt-4">
        <a href="menuprincipal.php" class="btn btn-secondary">Voltar ao Menu</a>
    </div>

</div>

</body>
</html>
