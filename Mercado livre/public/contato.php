<?php
// index.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Central de Ajuda</title>
  <link rel="stylesheet" href="contato.css"> <!-- linka com o CSS que te passei -->
</head>
<body>

<div class="header">
  <div class="header__row">
    <button class="btn-back">←</button>
    <div></div>
    <div class="logo"><span class="logo__icon">☝️</span> Clickaê</div>
  </div>
</div>

<h1 class="title">Como podemos te ajudar?</h1>

<section class="panel">
  <div class="panel__inner">
    <form action="processa.php" method="POST">

      <!-- Barra de busca -->
      <div class="search">
        <div class="search__icon">🔍</div>
        <input type="text" name="busca" placeholder="Digite sua dúvida">
        <button type="submit" style="display:none"></button>
      </div>

      <!-- Seção Compras -->
      <h2 class="section-title block">Compras</h2>
      <div class="list">
        <button class="card" type="submit" name="opcao" value="administrar">
          <div class="card__icon">👜</div>
          <div class="card__text">
            <div class="card__title">Administrar e cancelar compras</div>
            <div class="card__subtitle">Pagar, rastrear envios, alterar, reclamar ou cancelar compras</div>
          </div>
          <div class="card__chev">›</div>
        </button>

        <button class="card" type="submit" name="opcao" value="devolucoes">
          <div class="card__icon">↩</div>
          <div class="card__text">
            <div class="card__title">Devoluções e reembolsos</div>
            <div class="card__subtitle">Devolver um produto ou consultar por estorno de compra</div>
          </div>
          <div class="card__chev">›</div>
        </button>

        <button class="card" type="submit" name="opcao" value="faq">
          <div class="card__icon">?</div>
          <div class="card__text">
            <div class="card__title">Perguntas frequentes sobre compras</div>
          </div>
          <div class="card__chev">›</div>
        </button>
      </div>

      <!-- Seção Vendas -->
      <h2 class="section-title block">Vendas</h2>
      <div class="list">
        <button class="card" type="submit" name="opcao" value="vendas">
          <div class="card__icon">🏷️</div>
          <div class="card__text">
            <div class="card__title">Reputação, vendas e envio</div>
            <div class="card__subtitle">Perguntar sobre sua reputação, envio, pagamento ou devolução</div>
          </div>
          <div class="card__chev">›</div>
        </button>
      </div>
    </form>
  </div>
</section>

</body>
</html>