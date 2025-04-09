<?php

function deletarCliente ($conexao, $idcliente) {
    $sql = "DELETE FROM tb_cliente WHERE idcliente = ?";
    $comando = mysqli_prepare ($conexao, $sql);

    mysqli_stmt_bind
}


?>