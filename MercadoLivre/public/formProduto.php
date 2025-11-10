<?php
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

if (isset($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_produto WHERE idproduto = $id";
    $resultados = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_array($resultados);

    $nome = $linha['nome'];
    $descricao = $linha['descricao'];
    $valor = $linha['valor'];
    $estoque = $linha['estoque'];
    $estado = $linha['estado'];
    $status = $linha['status'];
    $categoria = $linha['categoria_idcategoria'];

    $botao = "Atualizar";

} else {

    $id = 0;
    $nome = "";
    $descricao = "";
    $valor = "";
    $estoque = "";
    $estado = "";
    $status = "";
    $categoria = "";

    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Produto</title>
</head>
<body>

<form action="salvarProduto.php?id=<?php echo $id; ?>" method="post">

    <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome"><br><br>

    <input type="text" name="descricao" value="<?php echo $descricao; ?>" placeholder="Descrição"><br><br>

    <input type="text" name="valor" value="<?php echo $valor; ?>" placeholder="Valor"><br><br>

    <input type="text" name="estoque" value="<?php echo $estoque; ?>" placeholder="Estoque"><br><br>

    <input type="text" name="estado" value="<?php echo $estado; ?>" placeholder="Estado"><br><br>

    <input type="text" name="status" value="<?php echo $status; ?>" placeholder="Status"><br><br>

    <label>Categoria:</label><br>
    <select name="categoria">
        <?php
            $lista_categoria = listarCategoria($conexao);
            foreach ($lista_categoria as $linha_cat) {
                $idcat = $linha_cat['idcategoria'];
                $nomecat = $linha_cat['nome'];
                $selecionado = ($idcat == $categoria) ? "selected" : "";
                echo "<option value='$idcat' $selecionado>$nomecat</option>";
            }
        ?>
    </select><br><br>

    <input type="submit" value="<?php echo $botao; ?>">

</form>

</body>
</html>
