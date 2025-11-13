<?php
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_produto WHERE idproduto = $id";
    $resultados = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_array($resultados);

    $nome = $linha['nome'];
    $descricao = $linha['descricao'];
    $valor = $linha['valor'];
    $estoque = $linha['estoque'];
    $estado = $linha['estado'];
    $status = $linha['status'];
    $categoria = $linha['categoria_idcategoria'];
    $foto = $linha['foto'] ?? "";

    $botao = "Atualizar";
} else {
    $id = 0;
    $nome = "";
    $descricao = "";
    $valor = "";
    $estoque = "";
    $estado = "";
    $status = "";
    $categoria = "";
    $foto = "";

    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-light border-bottom shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="../paginas/menuprincipal.php">Clickaê</a>
  </div>
</nav>

<div class="container py-5">
  <div class="card mx-auto shadow-sm" style="max-width: 700px;">
    <div class="card-header text-center fw-bold fs-4 bg-white">
      <?php echo $botao; ?> Produto
    </div>
    <div class="card-body">
      <form action="salvarProduto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label fw-semibold">Nome</label>
          <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Descrição</label>
          <textarea name="descricao" class="form-control" rows="3" required><?php echo $descricao; ?></textarea>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Valor</label>
            <input type="number" step="0.01" name="valor" class="form-control" value="<?php echo $valor; ?>" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Estoque</label>
            <input type="number" name="estoque" class="form-control" value="<?php echo $estoque; ?>" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Estado</label>
            <input type="text" name="estado" class="form-control" value="<?php echo $estado; ?>" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Status</label>
            <input type="text" name="status" class="form-control" value="<?php echo $status; ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Categoria</label>
            <select name="categoria" class="form-select" required>
              <option value="">Selecione...</option>
              <?php
              $lista_categoria = listarCategoria($conexao);
              foreach ($lista_categoria as $linha_cat) {
                  $idcat = $linha_cat['idcategoria'];
                  $nomecat = $linha_cat['nome'];
                  $selecionado = ($idcat == $categoria) ? "selected" : "";
                  echo "<option value='$idcat' $selecionado>$nomecat</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Foto do Produto</label>
          <input type="file" name="foto" class="form-control" accept="image/*">
          <?php if (!empty($foto)) { ?>
            <div class="mt-3 text-center">
              <img src="../imagens/<?php echo $foto; ?>" alt="Foto do produto" class="img-thumbnail" width="150">
            </div>
          <?php } ?>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary px-4"><?php echo $botao; ?></button>
          <a href="menuprincipal.php" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
      </form>
    </div>
  </div>x
</div>

<footer class="bg-light text-center text-lg-start fixed-bottom border-top">
  <div class="text-center p-2">
    © 2025 Clickaê — Todos os direitos reservados
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
