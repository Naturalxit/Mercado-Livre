<?php
if (isset($_GET['id'])) {
    // echo "editar";

    require_once "conexao.php";
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_categoria WHERE idcategoria = $id";

    $resultados = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_array($resultados);

    $categoria = $linha['categoria'];


    $botao = "Atualizar";

} else {
    // echo "novo";
    $id = 0;
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
      <link rel="stylesheet" href="./css/categoria.css">
</head>
<body>
    
    <div class="topo">
        <i class="fa-solid fa-hand-pointer"></i> <span>Clickaê</span>
    </div> <br><br>

<div class="profile-info">
    
    <div class="corpo">

        Cadastrar Categoria <br><br>

        <form action="salvarcategoria.php?id=<?php echo $id;?>" method="post">
            
            <input type="text" categoria="categoria" value="<?php echo $categoria; ?>" placeholder="Nome da Categoria" > <br><br>

            <div class="botao">

                <input type="submit" value="<?php echo $botao; ?>">

            </div>