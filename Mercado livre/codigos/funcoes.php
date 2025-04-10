<?php
function editarUsuario($conexao, $email, $senha, $tipo, $idusuario) {
    $sql = "UPDATE tb_usuario SET email=?, senha=?, tipo=? WHERE idusuario =?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssi', $email, $senha, $tipo, $idusuario);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function deletarUsuario($conexao, $idusuario) {
    $sql = "DELETE FROM tb_usuario WHERE idusuario= ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};

function cadastrarVendedor($conexao, $nome, $cpf, $endereco, $telefone) {
    $sql = "INSERT INTO tb_vendedor (nome, cpf, endereco, telefone) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $cpf, $endereco);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function listarVendedor($conexao) {
    $sql = "SELECT * FROM tb_vendedor";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_vendedores = [];
    while ($vendedor = mysqli_fetch_assoc($resultado)) {
        $lista_vendedores[] = $vendedor;
    }

    mysqli_stmt_close($comando);
    return $lista_vendedores;
};

function salvarVendedor($conexao, $nome, $cpf, $endereco, $telefone) {
    $sql = "INSERT INTO tb_vendedor (nome, cpf, endereco, telefone) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $cpf, $endereco, $telefone);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function salvarProduto($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status) {
    $sql = "INSERT INTO tb_produto (nome, tipo, estado, valor, estoque, descricao, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssdiss', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status);
    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function cadastrarPedido($conexao, $total, $Produto_idproduto, $Cliente_idcliente) {
    $sql = "INSERT INTO tb_pedido (total, Produto_idproduto, Cliente_idcliente) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'dii', $total, $Produto_idproduto, $Cliente_idcliente);
    
    $funcionou = mysqli_stmt_execute($comando);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
    mysqli_stmt_close($comando);
    return $funcionou;
};

//function editarProduto($conexao, $nome, $tipo, $preco_compra, $preco_venda, $margem_lucro, $quantidade, $idproduto) {
    //$sql = "UPDATE tb_produto SET nome=?, tipo=?, preco_compra=?, preco_venda=?, margem_lucro=?, quantidade=? WHERE idproduto=?";
    //$comando = mysqli_prepare($conexao, $sql);
    
    //mysqli_stmt_bind_param($comando, 'ssdddii', $nome, $tipo, $preco_compra, $preco_venda, $margem_lucro, $quantidade, $idproduto);
    
    //$funcionou = mysqli_stmt_execute($comando);
    
    //mysqli_stmt_close($comando);
    //return $funcionou;
//};
 ?>