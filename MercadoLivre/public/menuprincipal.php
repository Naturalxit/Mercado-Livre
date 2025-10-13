<?php
session_start();
require_once "../codigos/funcoesdomeusite.php";
require_once "../controle/conexao.php";

// --- localizar a variável de conexão (compatível com vários nomes) ---
$db = null;
if (isset($conn) && $conn instanceof mysqli) {
    $db = $conn;
} elseif (isset($conexao) && $conexao instanceof mysqli) {
    $db = $conexao;
} elseif (isset($mysqli) && $mysqli instanceof mysqli) {
    $db = $mysqli;
}

if (!$db) {
    die("Erro: conexão com o banco não encontrada. Verifique ../controle/conexao.php (procure por \$conn ou \$conexao).");
}

// --- definir nome do usuário a exibir ---
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
            if (method_exists($stmt, 'get_result')) {
                $res = $stmt->get_result();
                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    if (!empty($row['nome'])) {
                        $usuarioLogado = $row['nome'];
                        $_SESSION['usuario'] = $usuarioLogado;
                    }
                }
            } else {
                $stmt->bind_result($nome);
                if ($stmt->fetch() && !empty($nome)) {
                    $usuarioLogado = $nome;
                    $_SESSION['usuario'] = $usuarioLogado;
                }
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
      background-color: #c6e2e2;
    }

    /* --- Banner de ponta a ponta estilo Mercado Livre --- */
    .banner-wrapper {
      width: 100vw;
      position: relative;
      left: 50%;
      right: 50%;
      margin-left: -50vw;
      margin-right: -50vw;
      overflow: hidden;
    }

    .carousel-inner img {
      width: 100%;
      height: 400px; /* altura fixa estilo Mercado Livre */
      object-fit: cover; /* recorta proporcionalmente */
      object-position: center; /* centraliza a imagem */
    }

    .carousel-indicators [data-bs-target] {
      background-color: #333;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      filter: invert(1);
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-dark" href="menuprincipal.php">
        <i class="fa-solid fa-hand-pointer"></i> Clickaê
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menuNav">

        <!-- Campo de busca -->
        <form class="d-flex mx-auto" role="search" style="max-width:500px; width:100%;">
          <input class="form-control me-2" type="search" placeholder="Buscar produto..." aria-label="Buscar">
          <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </form>

        <!-- Menus -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
              Categorias
            </a>
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
        </ul>

        <!-- Perfil e carrinho -->
        <ul class="navbar-nav ms-auto align-items-center gap-3">
          <li class="nav-item">
            <a class="text-success fw-semibold" href="fretegratis.php"><i class="fa-solid fa-truck-fast"></i> Frete Grátis</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown">
              <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($usuarioLogado); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="perfil.php"><i class="fa-solid fa-id-card"></i> Meu Perfil</a></li>
              <li><a class="dropdown-item" href="meuspedidos.php"><i class="fa-solid fa-box"></i> Meus Pedidos</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="deslogar.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="carrinho.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Carrinho</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🚩 BANNER DE PONTA A PONTA -->
  <div class="banner-wrapper mt-0">
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">

      <div class="carousel-indicators">
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="banner1.jpg" alt="Banner 1">
        </div>
        <div class="carousel-item">
          <img src="../banners/banner2.jpg" alt="Banner 2">
        </div>
        <div class="carousel-item">
          <img src="../banners/banner3.jpg" alt="Banner 3">
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>

  <!-- CONTEÚDO PRINCIPAL -->
  <div class="container mt-5">
    <h2 class="text-center text-dark">Bem-vindo à Clickaê, <?php echo htmlspecialchars($usuarioLogado); ?>!</h2>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
