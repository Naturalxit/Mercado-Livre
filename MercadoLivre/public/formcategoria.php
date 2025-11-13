<?php
require_once "../controle/conexao.php";


if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM categoria WHERE idcategoria = $id";
    $resultados = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_array($resultados);

    $categoria = $linha['categoria'];
    $botao = "Atualizar";
} else {
    $id = 0;
    $categoria = "";
    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Categoria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-light border-bottom shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="menuprincipal.php">Clickaê</a>
  </div>
</nav>

<!-- Conteúdo -->
<div class="container py-5">
  <div class="card mx-auto shadow-sm" style="max-width: 600px;">
    <div class="card-header text-center fw-bold fs-4 bg-white">
      <?php echo $botao; ?> Categoria
    </div>
    <div class="card-body">
      <form action="salvarcategoria.php?id=<?php echo $id; ?>" method="POST">
        <div class="mb-3">
          <label class="form-label fw-semibold">Nome da Categoria</label>
          <input type="text" name="categoria" class="form-control" placeholder="Digite o nome da categoria" value="<?php echo $categoria; ?>" required>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary px-4"><?php echo $botao; ?></button>
          <a href="menuprincipal.php" class="btn btn-secondary ms-2">Voltar ao Menu</a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Rodapé fixo -->
<footer class="bg-light text-center text-lg-start fixed-bottom border-top">
  <div class="text-center p-2">
    © 2025 Clickaê — Todos os direitos reservados
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
