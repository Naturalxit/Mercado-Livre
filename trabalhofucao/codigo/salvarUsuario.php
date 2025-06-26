<?php

require_once "conexao.php";

$nome   = $_POST['nome'];
$email  = $_POST['email'];
$senha  = $_POST['senha'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO tb_usuario (nome, email, senha, cpf, endereco, foto, telefone)
        VALUES ('$nome', '$email', '$senha_hash', '000.000.000-00', 'Rua Exemplo, 123', 'foto.jpg', '(00) 00000-0000')";


mysqli_query($conexao, $sql);

header("Location: index.php");
?>
