<?php
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produto = pesquisarProduto($conexao, $id);

    $nome = $produto['nome'];
    $valor = $produto['valor'];
    $estoque = $produto['estoque'];
    $descricao = $produto['descricao'];
    $estado = $produto['estado'];
    $categoria = $produto['categoria_idcategoria'];

    $botao = "Atualizar";
} else {
    $id = 0;
    $nome = "";
    $valor = "";
    $estoque = "";
    $descricao = "";
    $estado = "";
    $categoria = "";

    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro de Produto</title>
<link rel="stylesheet" href="./css/formcliente.css">
</head>

<body>
<div class="topo">
    <h1>Cadastro de Produto</h1>
</div><br><br>

<div class="corpo">
<form action="salvarProduto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

    Foto:<br>
    <input type="file" name="foto"><br><br>

    Nome:<br>
    <input type="text" name="nome" value="<?php echo $nome; ?>"><br><br>

    Valor:<br>
    <input type="text" name="valor" value="<?php echo $valor; ?>"><br><br>

    Estoque:<br>
    <input type="number" name="estoque" value="<?php echo $estoque; ?>"><br><br>

    Estado (novo/usado):<br>
    <input type="text" name="estado" value="<?php echo $estado; ?>"><br><br>

    Categoria:<br>
    <input type="number" name="categoria" value="<?php echo $categoria; ?>"><br><br>

    Descrição:<br>
    <textarea name="descricao"><?php echo $descricao; ?></textarea><br><br>

    <input type="submit" value="<?php echo $botao; ?>">

</form>
</div>
</body>
</html>
