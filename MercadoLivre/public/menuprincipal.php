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

// prioridade 1: $_SESSION['usuario'] (se seu login já salva o nome)
if (!empty($_SESSION['usuario'])) {
    $usuarioLogado = $_SESSION['usuario'];
}
// prioridade 2: buscar pelo id em $_SESSION['idusuario']
elseif (!empty($_SESSION['idusuario'])) {
    $idusuario = (int) $_SESSION['idusuario'];

    $sql = "SELECT nome FROM tb_usuario WHERE idusuario = ? LIMIT 1";
    $stmt = $db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $idusuario);

        if ($stmt->execute()) {
            // se get_result estiver disponível (mysqlnd) usamos ele
            if (method_exists($stmt, 'get_result')) {
                $res = $stmt->get_result();
                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    if (!empty($row['nome'])) {
                        $usuarioLogado = $row['nome'];
                        // opcional: salvar no session para evitar várias consultas
                        $_SESSION['usuario'] = $usuarioLogado;
                    }
                }
            } else {
                // fallback sem get_result: bind_result + fetch
                $stmt->bind_result($nome);
                if ($stmt->fetch() && !empty($nome)) {
                    $usuarioLogado = $nome;
                    $_SESSION['usuario'] = $usuarioLogado;
                }
            }
        }
        $stmt->close();
    } else {
        // prepare falhou — em ambiente dev você pode debugar:
        // die("Erro ao preparar consulta: " . $db->error);
        // manter 'Visitante' se falhar
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Clickaê Loja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/menuprincipal2.css">
  <script src="https://kit.fontawesome.com/8dcbf7f2b4.js" crossorigin="anonymous"></script>
</head>

<body style="background-color:#c6e2e2;">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container-fluid">

      <!-- LOGO -->
      <a class="navbar-brand fw-bold text-dark" href="menuprincipal.php">
        <i class="fa-solid fa-hand-pointer"></i> Clickaê
      </a>

      <!-- BOTÃO MOBILE -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav"
        aria-controls="menuNav" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- CONTEÚDO -->
      <div class="collapse navbar-collapse" id="menuNav">
        
        <!-- CAMPO DE BUSCA CENTRAL -->
        <form class="d-flex mx-auto" role="search" style="max-width:500px; width:100%;">
          <input class="form-control me-2" type="search" placeholder="Buscar produto..." aria-label="Buscar">
          <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </form>

        <!-- LINKS DA ESQUERDA -->
        <ul class="navbar-nav mb-2 mb-lg-0">

          <!-- CATEGORIAS -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
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

          <!-- OUTROS LINKS -->
          <li class="nav-item"><a class="nav-link" href="ofertas.php">Ofertas</a></li>
          <li class="nav-item"><a class="nav-link" href="cupons.php">Cupons</a></li>
          <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
        </ul>

        <!-- SEÇÃO DIREITA -->
        <ul class="navbar-nav ms-auto align-items-center gap-3">
          <!-- FRETE -->
          <li class="nav-item">
            <span class="text-success fw-semibold"><i class="fa-solid fa-truck-fast"></i> Frete Grátis</span>
          </li>

          <!-- PERFIL -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($usuarioLogado); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
              <li><a class="dropdown-item" href="perfil.php"><i class="fa-solid fa-id-card"></i> Meu Perfil</a></li>
              <li><a class="dropdown-item" href="meus_pedidos.php"><i class="fa-solid fa-box"></i> Meus Pedidos</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="deslogar.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
          </li>

          <!-- CARRINHO -->
          <li class="nav-item">
            <a href="carrinho.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Carrinho</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- CONTEÚDO PRINCIPAL -->
  <div class="container mt-5">
    <h2 class="text-center text-dark">Bem-vindo à Clickaê, <?php echo htmlspecialchars($usuarioLogado); ?>!</h2>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
