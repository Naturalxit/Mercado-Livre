<?php
    require_once "verificaLogado.php";

    $nome_usuario = $_SESSION['nome'];
    //$tipo_usuario = $_SESSION['tipo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>trabalho das funções</h1>

    <p>Bom dia,<?php echo $nome_usuario . "."; ?></p>
    <ul>
            <a href="deslogar.php">Sair</a>
        </li>
    </ul>
</body>
</html>
