<?php
session_start();
require_once "../controle/conexao.php";

$db = $conn ?? $conexao ?? $mysqli ?? null;
if (!$db) die("Erro: conexão com o banco não encontrada.");

// Defina o ID da categoria "Veículos"
$idCategoria = 1; // <-- TROQUE SE PRECISAR

$sql = "SELECT p.*, c.nome AS nome_categoria
        FROM tb_produto p
        INNER JOIN tb_categoria c ON p.idcategoria = c.idcategoria
        WHERE p.idcategoria = ?
        ORDER BY p.idproduto DESC";

$stmt = $db->prepare($sql);
$stmt->bind_param("i", $idCategoria);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Veículos - Clickaê</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "menuprincipal.php"; ?>

<div class="container mt-5">
<h3 class="text-center mb-4">Veículos</h3>
<div class="row">

<?php while ($p = $result->fetch_assoc()) {
      $foto = !empty($p['foto']) ? $p['foto'] : 'padrao.jpg';
?>
  <div class="col-md-3 mb-4">
    <div class="card shadow-sm">
      <img src="fotos/<?php echo $foto; ?>" class="card-img-top">
      <div class="card-body text-center">
        <h5><?php echo htmlspecialchars($p['nome']); ?></h5>
        <p class="text-success fw-bold">R$ <?php echo number_format($p['valor'], 2, ",", "."); ?></p>
      </div>
    </div>
  </div>
<?php } ?>

</div>
</div>

</body>
</html>
