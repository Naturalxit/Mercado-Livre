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

function editarVendedor() {};

function deletarVendedor() {};

function listarVendedor() {};

function salvarVendedor() {};

function cadastrarProduto() {};

function editarProduto() {};

function deletarProduto() {};

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


function salvarProduto ($conexao, $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) {
    $sql = "INSERT INTO tb_produto ($nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare ($conexao, $sql);

    mysqli_stmt_bind_param ($comando, 'sssdisss', $nome, $tipo, $estado, $valor, $estoque, $descricao, $status, $categoria);

    $funcionou = mysqli_stmt_execute ($comando);

    $idproduto = mysqli_stmt_insert_id ($comando);
    
    mysqli_stmt_close ($comando);
    
    return $idproduto;
};

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
