<?php
session_start();
require_once "../controle/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Carrinho de Compras</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Carrinho de Compras</h2>

  <?php
  // Se o carrinho estiver vazio
  if (empty($_SESSION['carrinho'])) {
      echo "<div class='alert alert-warning text-center shadow-sm'>Seu carrinho está vazio.</div>";
  } else {
      echo "<table class='table table-bordered bg-white shadow-sm'>";
      echo "<thead class='table-secondary'>
              <tr>
                <th>Foto</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Total</th>
                <th>Ações</th>
              </tr>
            </thead><tbody>";

      $totalGeral = 0;

      foreach ($_SESSION['carrinho'] as $item) {
          $subtotal = $item['valor'] * $item['quantidade'];
          $totalGeral += $subtotal;

          echo "<tr>
                  <td><img src='fotos/{$item['foto']}' width='70' height='70' class='rounded'></td>
                  <td>{$item['nome']}</td>
                  <td>{$item['quantidade']}</td>
                  <td>R$ " . number_format($item['valor'], 2, ',', '.') . "</td>
                  <td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>
                  <td>
                    <a href='remover_carrinho.php?id={$item['id']}' class='btn btn-danger btn-sm'>
                      Remover
                    </a>
                  </td>
                </tr>";
      }

      echo "</tbody></table>";

      echo "<h4 class='text-end fw-bold'>Total: R$ " . number_format($totalGeral, 2, ',', '.') . "</h4>";

      // Botão para finalizar compra
      echo "<div class='text-end mt-4'>
              <form action='finalizar.php' method='POST'>
                <button type='submit' class='btn btn-success btn-lg'>Finalizar Compra</button>
              </form>
            </div>";
  }
  ?>
</div>

</body>
</html>
