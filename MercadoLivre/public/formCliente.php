<?php
session_start();

// Verifica login
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: index.php");
    exit;
}

$idusuario = $_SESSION['idusuario'];

require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

// Primeiro verifica se já existe cliente para este usuário
$sql = "SELECT * FROM tb_cliente WHERE idusuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Já existe cliente → edição
    $cliente = $resultado->fetch_assoc();
    $id = $cliente['idcliente'];
    $nome = $cliente['nome'];
    $cpf = $cliente['cpf'];
    $endereco = $cliente['endereco'];
    $botao = "Atualizar";
} else {
    // Não existe cliente → cadastro
    $id = 0;
    $nome = "";
    $cpf = "";
    $endereco = "";
    $botao = "Cadastrar";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="./css/formcliente.css">
</head>
<body>
    <div class= "topo">
        <h1>Cadastro de Cliente</h1>
    </div> <br>
    <form action="salvarCliente.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        Foto: <br>
        <input type="file" name="foto"> <br><br>

        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>

        CPF: <br>
        <input type="text" name="cpf" value="<?php echo $cpf; ?>"> <br><br>

        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>"> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>
