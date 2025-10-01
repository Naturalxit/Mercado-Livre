<?php
require_once "../controle/conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM tb_usuario WHERE email = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 0) {
    header("Location: index.php");
    exit;
} else {
    $linha = mysqli_fetch_assoc($resultado);

    $senha_banco = $linha['senha'];
    $tipo        = $linha['tipo'];
    $nome        = $linha['nome'];
    $idusuario   = $linha['idusuario'];

    if (password_verify($senha, $senha_banco)) {
        session_start();
        $_SESSION['logado']    = true;   // melhor boolean do que string
        $_SESSION['tipo']      = $tipo;
        $_SESSION['nome']      = $nome;
        $_SESSION['idusuario'] = $idusuario;

        header("Location: menuprincipal.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}
?>
