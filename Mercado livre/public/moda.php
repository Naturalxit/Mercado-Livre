<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Moda - Clickaê</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #c6dede;
    }

    .header {
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 30px;
      border-bottom: 1px solid #ccc;
    }

    .header .left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .header .left a {
      font-size: 28px;
      text-decoration: none;
      color: black;
    }

    .header .left span {
      font-size: 22px;
      font-weight: bold;
    }

    .header .logo {
      height: 40px;
    }

    .produtos {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      padding: 30px;
    }

    .produto {
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      text-align: center;
      padding: 10px;
    }

    .produto img {
      max-width: 100%;
      height: 220px;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .produto .nome {
      font-size: 15px;
      margin-bottom: 10px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .produto .preco {
      font-size: 22px;
      font-weight: bold;
      color: black;
      margin-bottom: 10px;
    }

  </style>
</head>
<body>

  <!-- Cabeçalho da categoria -->
  <div class="header">
    <div class="left">
      <a href="javascript:history.back()">←</a>
      
      <span>Moda</span>
    </div>
    <img src="logo.png" alt="Clickaê" class="logo">
  </div>

  <!-- Produtos -->
  <div class="produtos">
    <div class="produto">
    <img src="" alt="">
      <div class="nome">Homem Camiseta Nike Pro Preta</div>
      <div class="preco">R$97,99</div>
    </div>

    <div class="produto">
        <img src="" alt="">
      <div class="nome">Calça Paper Cargo Preta</div>
      <div class="preco">R$63,99</div>
    </div>

    <div class="produto">
      <img src="" alt="">
      <div class="nome">Vestido de princesa de manga curta com estampa floral</div>
      <div class="preco">R$86,99</div>
    </div>

    <!-- Adicione mais produtos conforme necessário -->
  </div>

</body>
</html>
