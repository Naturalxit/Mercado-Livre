<?php
require_once "conexao.php";
session_start(); // Sempre no topo antes de qualquer saída

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM tb_usuario WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) == 0) {
    // Nenhum usuário com esse e-mail
    header("Location: index.php");
    exit;
} else {
    $linha = mysqli_fetch_array($resultado);
    $senha_banco = $linha['senha'];
    $nome = $linha['nome'];

    if (password_verify($senha, $senha_banco)) {
        // Usuário válido
        $_SESSION['logado'] = 'sim';
        $_SESSION['nome'] = $nome;
        header("Location: home.php");
        exit;
    } else {
        // Senha incorreta
        header("Location: index.php");
        exit;
    }
}
?>
