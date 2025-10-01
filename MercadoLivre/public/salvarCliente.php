<?php
session_start();
$idusuario = $_SESSION['idusuario']; // pega id do usuário logado

require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];

$nome_arquivo = $_FILES['foto']['name'];
$caminho_temporario = $_FILES['foto']['tmp_name'];

// pega a extensão do arquivo
$extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

//gera um novo nome para o arquivo
$novo_nome = uniqid() . "." . $extensao;

//criando um novo caminho para o arquivo (usando o endereço da página)
//lembre-se de criar a pasta "fotos/" dentro da pasta "codigo".
//deve ajustar as permissões da pasta "fotos".
$caminho_destino = "fotos/" . $novo_nome;

//movendo o arquivo para o servidor
move_uploaded_file($caminho_temporario, $caminho_destino);



if ($id == 0) {
    $idcliente = salvarCliente($conexao, $nome, $cpf, $endereco, $novo_nome, $idusuario);
    header("Location: mostrarCadastro.php?idcliente=$idcliente&idusuario=$idusuario");
    exit;
} else {
    editarCliente($conexao, $nome, $cpf, $endereco, $id, $idusuario, $novo_nome);
    header("Location: listarClientes.php");
    exit;
}


