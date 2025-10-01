<?php
if (isset($_GET['id'])) {
    // echo "editar";

    require_once "conexao.php";
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_produto WHERE idproduto = $id";

    $resultados = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_array($resultados);

    $nome = $linha['nome'];
    $descricao['descricao'];
    $valor = $linha['valor'];
    $estoque = $linha['estoque'];
    $tipo = $linha['tipo'];
    $estado = ['estado'];
    $status = $linha['status'];
    $categoria = $linha['categoria'];


    $botao = "Atualizar";

} else {
    // echo "novo";
    $id = 0;
    $nome = "";
    $descricao = "";
    $valor = "";
    $estoque = "";
    $tipo= "";
    $estado = "";
    $status = "";
    $categoria = "";

    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="./css/adproduto.css">
</head>
<body>
    
    <div class="topo">
        <i class="fa-solid fa-hand-pointer"></i> <span>Clickaê</span>
    </div> <br><br>

<div class="profile-info">
    
    <div class="corpo">

        Cadastrar Produto <br><br>

        <form action="salvarproduto.php?id=<?php echo $id;?>" method="post">
            
            <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome do Produto" > <br><br>

            <input type="text" name="descricao" value="<?php echo $descricao; ?>" placeholder="Descrição do Produto"><br><br>

            <input type="text" name="valor" value="<?php echo $valor; ?>" placeholder="Valor do Produto"><br><br>

            <input type="text" name="estoque" value="<?php echo $estoque; ?>" placeholder="Estoque do Produto"><br><br>

            <input type="text" name="tipo" value="<?php echo $tipo; ?>" placeholder="Tipo do Produto" > <br><br>

            <input type="text" name="estado" value="<?php echo $estado; ?>" placeholder="Estado do Produto"><br><br>

            <input type="text" name="status" value="<?php echo $status; ?>" placeholder="Status do Produto"><br><br>


                <label for="categoria">Categoria:</label> <br>
                <select name="categoria" id="categoria">
                    <option value="Veículos">Veículos</option>
                    <option value="Eletrodomésticos">Eletrodomésticos</option>
                    <option value="Moda">Moda</option>
                    <option value="Pet Shop">Pet Shop</option>
                    <option value="Brinquedos">Brinquedos</option>
                    <option value="Imóveis">Imóveis</option>
                </select> <br><br> 

        <div class="botao">

            <input type="submit" value="<?php echo $botao; ?>">

        </div>

        </form>

    </div>

</div>

</body>
</html>