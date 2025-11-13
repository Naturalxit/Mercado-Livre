<?php
require_once "../controle/conexao.php";

// Verifica se está editando
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tb_cliente WHERE idcliente = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
        $nome = $cliente['nome'] ?? "";
        $cpf = $cliente['cpf'] ?? "";
        $telefone = $cliente['telefone'] ?? "";
        $endereco = $cliente['endereco'] ?? "";
        $foto = $cliente['foto'] ?? "";
    } else {
        $id = 0; $nome = ""; $cpf = ""; $telefone = ""; $endereco = ""; $foto = "";
    }

    $botao = "Atualizar";
} else {
    $id = 0; $nome = ""; $cpf = ""; $telefone = ""; $endereco = ""; $foto = "";
    $botao = "Cadastrar";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title><?php echo $botao; ?> Cliente</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.preview-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}
footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: #f8f9fa;
    border-top: 1px solid #ddd;
    text-align: center;
    padding: 10px 0;
}
</style>

<script>
function mascaraCPF(input) {
    let v = input.value.replace(/\D/g, "");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    input.value = v;
}
function mascaraTelefone(input) {
    let v = input.value.replace(/\D/g, "");
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
    v = v.replace(/(\d{5})(\d{4})$/, "$1-$2");
    input.value = v;
}
function previewFoto() {
    const file = document.querySelector('input[name="foto"]').files[0];
    const img = document.getElementById("imgPreview");
    if (file) {
        img.src = URL.createObjectURL(file);
    }
}
</script>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4><?php echo $botao; ?> Cliente</h4>
                </div>

                <div class="card-body">
                    <form action="salvarCliente.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                        <div class="text-center">
                            <img id="imgPreview" class="preview-img"
                                src="<?php echo (!empty($foto)) ? '../fotos_clientes/'.$foto : './img/user.png'; ?>"
                                alt="Pré-visualização da foto">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control" onchange="previewFoto()">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CPF</label>
                            <input type="text" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required maxlength="14" oninput="mascaraCPF(this)" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" maxlength="15" oninput="mascaraTelefone(this)" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <input type="text" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>" required class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success w-100"><?php echo $botao; ?></button>
                    </form>

                    <a href="listarClientes.php" class="btn btn-secondary w-100 mt-3">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <p class="mb-0">© 2025 - Sistema de Cadastro de Clientes</p>
</footer>
</body>
</html>
