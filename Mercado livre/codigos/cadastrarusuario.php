<?php

require_once "conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO tb_usuario (email, senha) VALUES ('$email', '$senha_hash')";

mysqli_query($conexao, $sql);

header("Location: index.php");