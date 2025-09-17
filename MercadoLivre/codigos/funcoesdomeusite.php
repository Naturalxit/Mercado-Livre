<?php
    // varchar, string, data -> s
    // inteiro -> i
    // dinheiro, decimal -> d
function salvarCliente($conexao, $nome, $cpf, $endereco, $foto) {//nao sei quem vez
    $sql = "INSERT INTO tb_cliente (nome, cpf, endereco, foto) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $cpf, $endereco,$foto);
    
    mysqli_stmt_execute($comando);
    
    $idcliente = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idcliente;
};

function editarUsuario($conexao, $nome, $email, $senha, $tipo) {//Roger testar
    $sql = "UPDATE tb_usuario SET nome=?, email=?, senha=?, tipo=?, WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    // varchar, string, data -> s
    // inteiro -> i
    // dinheiro, decimal -> d
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $email, $senha, $tipo, $idusuario);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function deletarUsuario($conexao,$idusuario) { //Roger testar
    $sql = "DELETE FROM tb_usuario WHERE idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};
function listarUsuario($conexao) { //Roger testar
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

function salvarUsuario($conexao, $nome, $email, $senha, $tipo) {//Roger testar
    $sql = "INSERT INTO tb_usuario (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $email, $senha, $tipo);
    
    mysqli_stmt_execute($comando);
    
    // retorna o valor do id que acabou de ser inserido
    $idusuario = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idusuario;
};

function editarVendedor($conexao, $nome, $cpf, $endereco, $telefone, $email, $senha, $tipo, $pedido_idpedido, $idCliente) {//nao sei quem vez
    $sql = "UPDATE Produto SET nome=?, cpf=?, endereco=?, telefone=?, email=?, senha=?, tipo=?, pedido_idpedido=? WHERE idCliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssssssii', $nome, $cpf, $endereco, $telefone, $email, $senha, $tipo, $pedido_idpedido, $idCliente);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function deletarVendedor($conexao, $idCliente) {//nao sei quem vez arrumar criar a tabela no banco
    $sql = "DELETE FROM Vendedor WHERE idCliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idCliente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};

function listarVendedor($conexao) {//nao sei quem vez arrumar criar a tabela no banco
    $sql = "SELECT * FROM Cliente";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_cliente = [];
    while ($cliente = mysqli_fetch_assoc($resultado)) {
        $lista_clientes[] = $cliente;
    }

    mysqli_stmt_close($comando);
    return $lista_clientes;
};

function cadastrarProduto($conexao, $nome, $tipo, $estado, $valor ,$estoque ,$descricao,$status,$categoria) {//Roger testar
    $sql = "INSERT INTO tb_produto (nome, tipo, estado, valor ,estoque ,descricao, status,categoria) VALUES (?, ?, ?, ?,?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssdisss', $nome, $tipo, $estado, $valor ,$estoque ,$descricao,$status,$categoria);
    
    mysqli_stmt_execute($comando);
    
    // retorna o valor do id que acabou de ser inserido
    $idproduto = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idproduto;
};

function editarProduto($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto) {//nao sei quem vez testar
    $sql = "UPDATE Produto SET nome=?, tipo=?, estado=?, valor=?, estoque=?, descricao=?, status=?, categoria=? WHERE idProduto=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssdisssi', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function deletarProduto($conexao, $idProduto) {//nao sei quem vez testar
    $sql = "DELETE FROM tb_roduto WHERE idProduto = ?";
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

function salvarProduto ($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) {//nao sei quem vez testar
    $sql = "INSERT INTO tb_produto ($nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare ($conexao, $sql);

    mysqli_stmt_bind_param ($comando, 'sssdisss', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria);

    $funcionou = mysqli_stmt_execute ($comando);

    $idproduto = mysqli_stmt_insert_id ($comando);
    
    mysqli_stmt_close ($comando);
    return $idproduto;
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

function cadastrarpedido($conexao, $valor, $data) {//Roger testar
    $sql = "INSERT INTO tb_pedido (valor, data) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ss', $valor, $data);
    
    mysqli_stmt_execute($comando);
    
    // retorna o valor do id que acabou de ser inserido
    $idpedido = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idpedido;
};

function editarVenda($conexao, $valor, $data, $idpedido) {//Roger testar
    $sql = "UPDATE tb_pedido SET valor=?, data=?,WHERE idpedido=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssi', $valor, $data, $idpedido);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function deletarVenda($conexao, $idProduto) {////Roger testar
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

function salvarVenda($conexao, $valor_total, $data, ) {//Roger testar
    $sql = "INSERT INTO tb_pedido (valor_total, data) VALUES (?, ?)";

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'is', $valor_total, $data);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
};

function cadastrarPagamento($conexao, $valor, $data) {//Roger testar
    $sql = "INSERT INTO tb_pedido (valor, data) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ss', $valor, $data);
    
    mysqli_stmt_execute($comando);
    
    // retorna o valor do id que acabou de ser inserido
    $idpedido = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idpedido;
};

function editarPagamento($conexao, $forma_pagamento, $pagamento, $data_pagamento ,$idtb_pagamento) {//Roger testar
    $sql = "UPDATE tb_pagamento SET forma_pagamento=?, pagamento=?, data_pagamento=?,WHERE idtb_pagamento=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssi', $forma_pagamento, $pagamento, $data_pagamento, $idtb_pagamento);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function listarPagamento($conexao) { //Roger testar
    $sql = "SELECT * FROM tb_pagamento";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_pagamento = [];
    while ($pagamento = mysqli_fetch_assoc($resultado)) {
        $lista_pagamento[] = $pagamento;
    }

    mysqli_stmt_close($comando);
    return $lista_pagamento;
};

function deletarPagamento($conexao, $idProduto) {////Roger testar
    $sql = "DELETE FROM tb_pagamento WHERE idtb_pagamento = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idtb_pagamento);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};

function salvarPagamento($conexao, $forma_pagamento, $pagamento,$data_pagamento) {//Roger testar
    $sql = "INSERT INTO tb_pagamento (forma_pagamento, pagamento,data_pagamento) VALUES (?, ?,?)";

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'sis', $forma_pagamento, $pagamento, $data_pagamento);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
};

function pesquisarClienteId($conexao, $idcliente) {
    $sql = "SELECT * FROM tb_cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idcliente);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $cliente = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $cliente;
};

function editarCliente($conexao, $nome, $cpf, $endereco, $idcliente) {
    $sql = "UPDATE tb_cliente SET nome=?, cpf=?, endereco=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    // varchar, string, data -> s
    // inteiro -> i
    // dinheiro, decimal -> d
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $cpf, $endereco, $idcliente);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function listarClientes($conexao) {
    $sql = "SELECT * FROM tb_cliente";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_clientes = [];
    while ($cliente = mysqli_fetch_assoc($resultado)) {
        $lista_clientes[] = $cliente;
    }

    mysqli_stmt_close($comando);
    return $lista_clientes;
};

function deletarCliente($conexao, $idcliente) {
    $sql = "DELETE FROM tb_cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idcliente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};
?>
