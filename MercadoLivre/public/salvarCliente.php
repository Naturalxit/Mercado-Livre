<?php
session_start();
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

$idusuario = $_SESSION['idusuario']; // usuário logado
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];

$novo_nome = "";
if (!empty($_FILES['foto']['name'])) {
    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
    $novo_nome = uniqid() . "." . $extensao;
    $caminho_destino = "../fotos_clientes/" . $novo_nome;
    if (!file_exists("../fotos_clientes")) mkdir("../fotos_clientes", 0777, true);
    move_uploaded_file($caminho_temporario, $caminho_destino);
}

// Verifica se já existe cliente para este usuário
$cliente_existente = pesquisarClientePorUsuario($conexao, $idusuario);

if ($cliente_existente) {
    // Atualiza cliente existente
    $idcliente = $cliente_existente['idcliente'];
    if ($novo_nome == "") $novo_nome = $cliente_existente['foto']; // mantém foto antiga
    editarCliente($conexao, $nome, $cpf, $endereco, $idcliente, $idusuario, $novo_nome);
} else {
    // Cria novo cliente
    $idcliente = salvarCliente($conexao, $nome, $cpf, $endereco, $novo_nome, $idusuario);
    if($idcliente === "erro_existente") {
        // Já existe cliente (apenas por segurança)
        header("Location: listarClientes.php");
        exit;
    }
}

// Redireciona após salvar/atualizar
header("Location: listarClientes.php");
exit;
?>
