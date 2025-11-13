<?php
session_start();
require_once "../codigos/funcoesdomeusite.php";
require_once "../controle/conexao.php";

// --- localizar conexão ---
$db = null;
if (isset($conn) && $conn instanceof mysqli) {
    $db = $conn;
} elseif (isset($conexao) && $conexao instanceof mysqli) {
    $db = $conexao;
} elseif (isset($mysqli) && $mysqli instanceof mysqli) {
    $db = $mysqli;
}
if (!$db) die("Erro: conexão com o banco não encontrada.");

// --- usuário logado ---
$usuarioLogado = 'Visitante';
if (!empty($_SESSION['usuario'])) {
    $usuarioLogado = $_SESSION['usuario'];
} elseif (!empty($_SESSION['idusuario'])) {
    $idusuario = (int) $_SESSION['idusuario'];
    $sql = "SELECT nome FROM tb_usuario WHERE idusuario = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $idusuario);
        if ($stmt->execute()) {
            $res = $stmt->get_result();
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $usuarioLogado = $row['nome'] ?? $usuarioLogado;
                $_SESSION['usuario'] = $usuarioLogado;
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Clickaê Loja</title>
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
.banner-wrapper img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}
.card {
    border: none;
    transition: transform 0.2s ease;
}
.card:hover {
    transform: scale(1.02);
}
.btn-primary {
    border-radius: 20px;
}
</style>
</head>
<body>

<!-- NAVBAR FIXA -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="menuprincipal.php"><i class="fa-solid fa-hand-pointer"></i> Clickaê</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuNav">
      <form class="d-flex mx-auto" role="search" style="max-width:450px; width:100%;">
        <input class="form-control form-control-sm me-2" type="search" placeholder="Buscar produto...">
        <button class="btn btn-outline-primary btn-sm" type="submit">Buscar</button>
      </form>

      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categorias</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="veiculo.php">Veículos</a></li>
            <li><a class="dropdown-item" href="eletrodomestico.php">Eletrodomésticos</a></li>
            <li><a class="dropdown-item" href="moda.php">Moda</a></li>
            <li><a class="dropdown-item" href="petshop.php">Pet Shop</a></li>
            <li><a class="dropdown-item" href="brinquedos.php">Brinquedos</a></li>
            <li><a class="dropdown-item" href="imoveis.php">Imóveis</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="ofertas.php">Ofertas</a></li>
        <li class="nav-item"><a class="nav-link" href="cupons.php">Cupons</a></li>
        <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
        <li class="nav-item dropdown ms-3">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($usuarioLogado); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="perfil.php"><i class="fa-solid fa-id-card"></i> Meu Perfil</a></li>
            <li><a class="dropdown-item" href="carrinho.php"><i class="fa-solid fa-box"></i> Meus Pedidos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="deslogar.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
          </ul>
        </li>
        <li class="nav-item ms-3">
          <a href="carrinho.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- BANNER -->
<div class="banner-wrapper">
  <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active"><img src="banner1.png" alt="Banner 1"></div>
      <div class="carousel-item"><img src="banner2.jpeg" alt="Banner 2"></div>
      <div class="carousel-item"><img src="banner3.jpeg" alt="Banner 3"></div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<!-- CONTEÚDO -->
<div class="container mt-5">
  <h2 class="text-center text-dark mb-4">Bem-vindo, <?php echo htmlspecialchars($usuarioLogado); ?>!</h2>
  <div class="row">
    <?php
    $result = $db->query("SELECT * FROM tb_produto ORDER BY idproduto DESC");
    while ($p = $result->fetch_assoc()) {
        $fotoProduto = !empty($p['foto']) ? $p['foto'] : 'padrao.jpg';
    ?>
    <div class="col-md-3 mb-4">
      <div class="card h-100 text-center">
        <img src="fotos/<?php echo $fotoProduto; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($p['nome']); ?>">
        <div class="card-body">
          <h6 class="fw-semibold"><?php echo htmlspecialchars($p['nome']); ?></h6>
          <p class="text-success fw-bold mb-2">R$ <?php echo number_format($p['valor'], 2, ",", "."); ?></p>
          <form method="post" action="adicionar_carrinho.php">
            <input type="hidden" name="idproduto" value="<?php echo $p['idproduto']; ?>">
            <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa-solid fa-cart-plus"></i> Adicionar
            </button>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
