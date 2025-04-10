<?php
function editarUsuario($conexao, $email, $senha, $tipo, $idusuario) {
    $sql = "UPDATE tb_usuario SET email=?, senha=?, tipo=? WHERE idusuario =?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssi', $email, $senha, $tipo, $idusuario);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

?>
