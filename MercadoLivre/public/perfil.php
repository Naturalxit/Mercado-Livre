<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Perfil - Clickaê</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #d0e6e7;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: white;
      padding: 10px 20px;
    }

    .header .logo {
      font-weight: bold;
      display: flex;
      align-items: center;
    }

    .header .logo img {
      margin-right: 10px;
    }

    .container {
      display: flex;
      padding: 40px;
    }

    .profile-pic {
      flex: 1;
      text-align: center;
    }

    .profile-pic img {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      border: 6px solid #333;
      background-color: #333;
    }

    .profile-info {
      flex: 1;
      padding: 0 40px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .profile-info input {
      padding: 12px;
      border-radius: 25px;
      border: none;
      font-size: 16px;
      background-color: #eee;
    }

    .footer {
      text-align: right;
      margin: 20px;
      font-size: 14px;
    }

    .back-button {
      background: #f5f5f5;
      border: none;
      padding: 10px;
      font-size: 18px;
      cursor: pointer;
    }
  </style>
</head>
<body>


<div class="header">
    <div class="left">
      <a href="javascript:history.back()">←</a>
      

    </div>
    <img src="logo.png" alt="Clickaê" class="logo">
  </div>

  <h2>Criar Perfil</h2>

  <div class="container">
    <div class="profile-pic">
      <img src="https://via.placeholder.com/200?text=Perfil" alt="Foto de perfil">
      <p>Perfil</p>
    </div>
    <div class="profile-info">
      <input type="text" placeholder="Nome Completo">
      <input type="text" placeholder="CPF">
      <input type="text" placeholder="Número de telefone">
      <input type="text" placeholder="Endereço">
      <input type="text" placeholder="Vendedor ou Cliente">
    </div>
  </div>

  <div class="footer">
  <a href="adicionarProduto.php">Adicionar produto</a>
  </div>
   <div class="footer">
  <a href="formCliente.php">Cadrastrar  Cliente</a>
  </div>

     <div class="footer">
  <a href="listarClientes.php"> Cliente</a>
  </div>


</body>
</html>
