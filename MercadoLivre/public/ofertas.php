<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clickaê - Ofertas</title>
    <link rel="stylesheet" href="./css/ofertas.css">
  </style>
</head>
<body>
   <!-- Cabeçalho da categoria -->
  <div class="header">
    <div class="left">
      <a href="javascript:history.back()">←</a>
      
      <span>Ofertas</span>
    </div>
    <img src="logo.png" alt="Clickaê" class="logo">
  </div>
   <!-- Barra de filtros -->
  <div class="filters">
    <div class="filter active">
      <img src="https://img.icons8.com/ios-filled/50/0000FF/money.png" alt="Ofertas">
      Todas as ofertas
    </div>

    <div>
     <a href="ofertarelampago.php" class="filter">
      <img src="https://img.icons8.com/ios-filled/50/000000/flash-on.png" alt="Relâmpago">
      Oferta relâmpago
    </a>
    </div>


    <div class="filter">
      <a href="desconto.php" class="filter">
      <img src="https://img.icons8.com/ios-filled/50/000000/piggy-bank.png" alt="Desconto">
      Desconto
    </a>
    </div>
  </div>
  
  <!-- Lista de veículos -->
  <div class="container">
    <div class="card">
      <img src="https://cdn.pixabay.com/photo/2017/03/27/14/56/car-2187220_1280.jpg" alt="Carro">
      <p>Carro Sedan 1.6 Flex</p>
      <div class="price">R$45.900,00</div>
    </div>

    <div class="card">
      <img src="https://cdn.pixabay.com/photo/2012/05/29/00/43/motorbike-49268_1280.jpg" alt="Moto">
      <p>Moto Esportiva 300cc</p>
      <div class="price">R$18.500,00</div>
    </div>

    <div class="card">
      <img src="https://cdn.pixabay.com/photo/2016/02/19/11/53/truck-1207819_1280.jpg" alt="Caminhão">
      <p>Caminhão de Carga</p>
      <div class="price">R$120.000,00</div>
    </div>

    <div class="card">
      <img src="https://cdn.pixabay.com/photo/2015/01/19/13/51/bike-604744_1280.jpg" alt="Bicicleta">
      <p>Bicicleta Mountain Bike</p>
      <div class="price">R$1.299,00</div>
    </div>

 
  </div>
</body>
</html>
