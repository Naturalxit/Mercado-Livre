<?php
    // varchar, string, data -> s
    // inteiro -> i
    // dinheiro, decimal -> d

//13 fuçoes


//// // // // // // // // Usuario  // // // // // // // // // // // // // //  

function editarUsuario($conexao, $nome, $email, $senha, $cpf, $endereco, $foto, $telefone, $idusuario) {
    $sql = "UPDATE tb_usuario SET nome=?, email=?, senha=?, cpf=?, endereco=?, foto=?, telefone=? WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'sssssssi', $nome, $email, $senha, $cpf, $endereco, $foto, $telefone, $idusuario);

    
    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
}

function deletarUsuario($conexao,$idusuario) { //test tem
    $sql = "DELETE FROM tb_usuario WHERE idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};
function listarUsuario($conexao) { //test tem
    $sql = "SELECT * FROM tb_usuario";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_usuario = [];
    while ($usuario = mysqli_fetch_assoc($resultado)) {
        $lista_usuario[] = $usuario;
    }

    mysqli_stmt_close($comando);
    return $lista_usuario;
};
function salvarUsuario($conexao, $nome, $email, $senha,  $cpf,$endereco,$foto,$telefone) {//test tem
    $sql = "INSERT INTO tb_usuario (nome, email, senha, cpf, endereco, foto, telefone) VALUES (?, ?, ?, ? , ? , ? , ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssssss', $nome, $email, $senha, $cpf,$endereco,$foto,$telefone);
    
    mysqli_stmt_execute($comando);
    
    // retorna o valor do id que acabou de ser inserido
    $idusuario = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idusuario;
};


//// // // // // // // // Produto  // // // // // // // // // // // // // //  
function cadastrarProduto($conexao, $nome, $tipo, $estado, $valor ,$estoque ,$descricao,$status,$categoria) {//Roger testar
    $sql = "INSERT INTO tb_produto (nome, tipo, estado, valor, estoque, descricao, status,$categoria) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssdisss', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria);
    
    mysqli_stmt_execute($comando);
    

    $idproduto = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idproduto;
};

function editarProduto($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto) {//nao sei quem vez testar
    $sql = "UPDATE tb_produto SET nome=?, tipo=?, estado=?, valor=?, estoque=?, descricao=?, status=?, categoria=? WHERE idProduto=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssdisssi', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function deletarProduto($conexao, $idProduto) {//lorena testar
    $sql = "DELETE FROM tb_produto WHERE idProduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idProduto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};

function listarProdutos($conexao) {//nao sei quem vez testar
    $sql = "SELECT * FROM tb_produto";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_produto = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $lista_produto[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $lista_produto;
};

function pesquisarProduto($conexao, $idproduto) {//Roger testar
    $sql = "SELECT * FROM tb_produto WHERE idproduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idproduto);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produto = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $produto;
};


//// // // // // // // // Pedido  // // // // // // // // // // // // // //  
function cadastrarpedido($conexao, $valor_total, $data_pagamento,$forma_pagamento,$status) {//Roger testar
    $sql = "INSERT INTO tb_pedido (valor_total,data_pagamento,forma_pagamento,status) VALUES (?, ?,?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssss', $valor_total, $data_pagamento,$forma_pagamento,$status);
    
    mysqli_stmt_execute($comando);
    
    // retorna o valor do id que acabou de ser inserido
    $idpedido = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idpedido;
};

function editarVenda($conexao, $valor_total, $data_pagamento, $forma_pagamento, $status, $idpedido) {
    $sql = "UPDATE tb_pedido  SET valor_total=?, data_pagamento=?, forma_pagamento=?, status=? WHERE idpedido=?";

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssssi', $valor_total, $data_pagamento, $forma_pagamento, $status, $idpedido);

    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);

    return $funcionou;
}

function deletarVenda($conexao, $idpedido) {////Roger testar
    $sql = "DELETE FROM tb_pedido WHERE idpedido = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idpedido);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};

function listarVenda($conexao) { //Roger testar
    $sql = "SELECT * FROM tb_pedido";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_pedido = [];
    while ($pedido = mysqli_fetch_assoc($resultado)) {
        $lista_pedido[] = $pedido;
    }

    mysqli_stmt_close($comando);
    return $lista_pedido;
};

