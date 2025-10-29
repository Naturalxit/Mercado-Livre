<?php
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

$id = $_GET["id"] ?? 0;
$nome = $_POST["nome"];
$valor = $_POST["valor"];
$estoque = $_POST["estoque"];
$descricao = $_POST["descricao"];
$estado = $_POST["estado"];
$categoria = $_POST["categoria"];

$foto = "";

// --- Verifica se uma imagem foi enviada ---
if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
    $nomeArquivo = $_FILES["foto"]["name"];
    $tmpArquivo = $_FILES["foto"]["tmp_name"];

    // Gerar nome único
    $foto = uniqid() . "_" . basename($nomeArquivo);
    $destino = "fotos/" . $foto;

    // Tenta mover o arquivo para a pasta fotos/
    if (!move_uploaded_file($tmpArquivo, $destino)) {
        // Se falhar, usa imagem padrão
        $foto = "padrao.jpg";
        // Opcional: log ou mensagem
        // echo "Falha ao mover arquivo, usando imagem padrão.";
    }
} else {
    // Nenhuma imagem enviada ou erro → usar imagem padrão
    $foto = "padrao.jpg";
}

// --- Atualizar ou inserir no banco ---
if ($id > 0) {
    // Atualizar produto
    $sql = $conexao->prepare("UPDATE tb_produto 
        SET nome=?, valor=?, estoque=?, descricao=?, estado=?, categoria_idcategoria=?, 
        foto=IF(?='','foto',?) 
        WHERE idproduto=?");

    if (!$sql) {
        die("Erro na preparação do SQL: " . $conexao->error);
    }

    $sql->bind_param("sdisssisi", $nome, $valor, $estoque, $descricao, $estado, $categoria, $foto, $foto, $id);
} else {
    // Inserir novo produto
    $sql = $conexao->prepare("INSERT INTO tb_produto 
        (nome, valor, estoque, descricao, estado, categoria_idcategoria, foto) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$sql) {
        die("Erro na preparação do SQL: " . $conexao->error);
    }

    $sql->bind_param("sdissss", $nome, $valor, $estoque, $descricao, $estado, $categoria, $foto);
}

// Executa o SQL e verifica erro
if (!$sql->execute()) {
    die("Erro ao salvar produto: " . $sql->error);
}

// Redireciona para o menu principal
header("Location: menuprincipal.php");
exit;
