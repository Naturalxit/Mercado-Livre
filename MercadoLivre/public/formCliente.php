<?php
    if (isset($_GET['id'])) {
        // echo "editar";

        require_once "conexao.php";
        require_once "funcoes.php";

        $id = $_GET['id'];
        
        $cliente = pesquisarUsuario($conexao, $id);
        $nome = $cliente['nome'];
        $cpf = $cliente['cpf'];
        $endereco = $cliente['endereco'];

        $botao = "Atualizar";
    }
    else {
        // echo "novo";
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
    </div> <br><br>

    <div class="corpo">
        
    <form action="salvarCliente.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        Foto: <br>
        <input type="file" name="foto"> <br><br>

<div class="profile-info">

        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>

        CPF: <br>
        <input type="text" name="cpf" value="<?php echo $cpf; ?>"> <br><br>

        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>"> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">

    </form>

</div>
    </div>

</body>
</html>
