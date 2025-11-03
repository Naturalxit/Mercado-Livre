<?php
require_once "../controle/conexao.php";

$id = $_GET['id'];
$categoria = $_POST['categoria'];

if ($id == 0) {
    echo "novo";
    $sql = "INSERT INTO categoria (categoria) VALUES ('$categoria')";

} else {
    echo "atualizar";
    $sql = "UPDATE categoria SET categora = '$categoria' WHERE idcategoria = $id";
}   
mysqli_query($conexao, $sql);

if ($id == 0) {
    // echo "novo";
    $sql = "INSERT INTO categoria (categoria) VALUES ('$categoria')";

} else {
    // echo "atualizar";
    $sql = "UPDATE categoria SET categoria = '$categoria' WHERE idcategoria = $id";
}
mysqli_query($conexao, $sql);