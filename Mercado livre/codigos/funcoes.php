<php?
function logarUsuario() {};

function salvarCliente($conexao, $nome, $cpf, $endereco, $telefone, $email, $senha) {
    $sql = "INSERT INTO tb_cliente (nome, cpf, endereco, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssssss', $nome, $cpf, $endereco, $telefone, $email, $senha);
    
    mysqli_stmt_execute($comando);
    
    $idcliente = mysqli_stmt_insert_id($comando);

    mysqli_stmt_close($comando);

    return $idcliente;
 };

function editarUsuario() {};
 
function deletarUsuario() {};

function listarUsuario() {};

function salvarUsuario() {};

function cadastrarVendedor() {};

function editarVendedor($conexao, $nome, $cpf, $endereco, $telefone, $email, $senha, $tipo, $pedido_idpedido, $idCliente) {
    $sql = "UPDATE Produto SET nome=?, cpf=?, endereco=?, telefone=?, email=?, senha=?, tipo=?, pedido_idpedido=? WHERE idCliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssssssii', $nome, $cpf, $endereco, $telefone, $email, $senha, $tipo, $pedido_idpedido, $idCliente);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};

function deletarVendedor($conexao, $idCliente) {
    $sql = "DELETE FROM Vendedor WHERE idCliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idCliente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};

function listarVendedor($conexao) {
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

function salvarVendedor() {};

function cadastrarProduto() {};

function editarProduto($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto) {
    $sql = "UPDATE Produto SET nome=?, tipo=?, estado=?, valor=?, estoque=?, descricao=?, status=?, categoria=? WHERE idProduto=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssdisssi', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria, $idProduto);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
};


function deletarProduto($conexao, $idProduto) {
    $sql = "DELETE FROM Produto WHERE idProduto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $idProduto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou; //true ou false
};


function listarProdutos($conexao) {
    $sql = "SELECT * FROM Produto";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_produto = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $lista_produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $lista_produtos;
};


public function salvarProduto ($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) {
    $sql = "INSERT INTO tb_produto ($nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare ($conexao, $sql);

    mysqli_stmt_bind_param ($comando, 'sssdisss', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria);

    $funcionou = mysqli_stmt_execute ($comando);

    $idproduto = mysqli_stmt_insert_id ($comando);
    
    mysqli_stmt_close ($comando);
    return $idproduto;
};

$teste = salvarProduto("","");

function pesquisarProduto() {};

function mostrarMenu() {};

function cadastrarVenda() {};

function editarVenda() {};

function deletarVenda() {};

function listarVenda() {};

function salvarVenda() {};

function cadastrarPagamento() {};

function editarPagamento() {};

function listarPagamento() {};

function cancelarPagamento() {};

function salvarPagamento() {};

function editarCarrinho() {};

function salvarEntrega() {};

function cadastrarDevolucao() {};

?>
