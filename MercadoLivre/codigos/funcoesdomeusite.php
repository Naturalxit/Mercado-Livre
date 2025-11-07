<?php
// ===================== CONEXÃO =====================
// O arquivo de conexão ($conexao) deve ser incluído antes de usar estas funções

// ===================== USUÁRIO =====================
function salvarUsuario($conexao, $nome, $email, $senha, $tipo) {
    $sql = "INSERT INTO tb_usuario (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $email, $senha, $tipo);
    mysqli_stmt_execute($comando);
    $idusuario = mysqli_stmt_insert_id($comando);
    mysqli_stmt_close($comando);
    return $idusuario;
}

function editarUsuario($conexao, $idusuario, $nome, $email, $senha, $tipo) {
    $sql = "UPDATE tb_usuario SET nome=?, email=?, senha=?, tipo=? WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssi', $nome, $email, $senha, $tipo, $idusuario);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

function deletarUsuario($conexao, $idusuario) {
    $sql = "DELETE FROM tb_usuario WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

function listarUsuarios($conexao) {
    $sql = "SELECT * FROM tb_usuario";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista[] = $row;
    }
    mysqli_stmt_close($comando);
    return $lista;
}

function pesquisarUsuario($conexao, $idusuario) {
    $sql = "SELECT * FROM tb_usuario WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);
    return $usuario;
}


// ===================== CLIENTE =====================

function salvarCliente($conexao, $nome, $cpf, $endereco, $foto, $idusuario) {
    // Antes de inserir, verifica se já existe cliente para este usuário
    $cliente_existente = pesquisarClientePorUsuario($conexao, $idusuario);
    if($cliente_existente){
        return "erro_existente"; // cliente já existe
    }

    $sql = "INSERT INTO tb_cliente (nome, cpf, endereco, foto, idusuario) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssi', $nome, $cpf, $endereco, $foto, $idusuario);
    mysqli_stmt_execute($comando);
    $idcliente = mysqli_stmt_insert_id($comando);
    mysqli_stmt_close($comando);
    return $idcliente;
}

function editarCliente($conexao, $nome, $cpf, $endereco, $idcliente, $idusuario, $foto) {
    $sql = "UPDATE tb_cliente SET nome=?, cpf=?, endereco=?, foto=? WHERE idcliente=? AND idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssii', $nome, $cpf, $endereco, $foto, $idcliente, $idusuario);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

function pesquisarClientePorUsuario($conexao, $idusuario) {
    $sql = "SELECT * FROM tb_cliente WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $cliente = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);
    return $cliente;
}

function listarClientes($conexao) {
    $sql = "SELECT * FROM tb_cliente";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista[] = $row;
    }
    mysqli_stmt_close($comando);
    return $lista;
}

function deletarCliente($conexao, $idcliente) {
    $sql = "DELETE FROM tb_cliente WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idcliente);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

// ===================== PRODUTO =====================
function salvarProduto($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) {
    $sql = "INSERT INTO tb_produto (nome, tipo, estado, valor, estoque, descricao, status, categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssdisss', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria);
    mysqli_stmt_execute($comando);
    $idproduto = mysqli_stmt_insert_id($comando);
    mysqli_stmt_close($comando);
    return $idproduto;
}

function editarProduto($conexao, $idProduto, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) {
    $sql = "UPDATE tb_produto SET nome=?, tipo=?, estado=?, valor=?, estoque=?, descricao=?, status=?, categoria=? WHERE idProduto=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssdisssi', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

function deletarProduto($conexao, $idProduto) {
    $sql = "DELETE FROM tb_produto WHERE idProduto=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idProduto);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

function listarProdutos($conexao) {
    $sql = "SELECT * FROM tb_produto";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista[] = $row;
    }
    mysqli_stmt_close($comando);
    return $lista;
}

function pesquisarProduto($conexao, $idProduto) {
    $sql = "SELECT * FROM tb_produto WHERE idProduto=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idProduto);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $produto = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);
    return $produto;
}


function listarCategoria($conexao) {
    $sql = "SELECT * FROM categoria";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista[] = $row;
    }
    mysqli_stmt_close($comando);
    return $lista;
}

function cadastrarCategoria($conexao, $nome) {
    $sql = "INSERT INTO categoria (nome) VALUES (?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 's', $nome);
    mysqli_stmt_execute($comando);
    $idcategoria = mysqli_stmt_insert_id($comando);
    mysqli_stmt_close($comando);
    return $idcategoria;
}

?>
