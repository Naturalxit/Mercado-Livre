<?php
require_once "../controle/conexao.php";

$id = $_GET['id'];
$categoria = $_POST['categoria'];


if ($id == 0) {
    $sql = "INSERT INTO categoria (nome) VALUES ('$categoria')";

} else {
    echo "atualizar";
    $sql = "UPDATE categoria SET nome = '$categoria' WHERE idcategoria = $id";
}   
mysqli_query($conexao, $sql);

header("Location: formProduto.php");
?>
