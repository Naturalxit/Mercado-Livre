<?php
session_start();
require_once "../controle/conexao.php";
require_once "../codigos/funcoesdomeusite.php";

$clientes = listarClientes($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Clientes</title>
<style>
body { font-family: Arial, sans-serif; margin: 20px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
th { background-color: #f2f2f2; }
img { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; }
.btn { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
.btn-editar { background-color: #4CAF50; color: white; }
.btn-deletar { background-color: #f44336; color: white; }
.btn-editar:hover, .btn-deletar:hover { opacity: 0.8; }
</style>
<script>
function confirmarDeletar(id) {
    if(confirm("Tem certeza que deseja deletar este cliente?")) {
        window.location.href = "deletarCliente.php?id=" + id;
    }
}
</script>
</head>
<body>

<h1>Lista de Clientes</h1>
<a href="formCliente.php"><button class="btn btn-editar">+ Novo Cliente</button></a>

<table>
<thead>
<tr>
    <th>Foto</th>
    <th>Nome</th>
    <th>CPF</th>
    <th>Endereço</th>
    <th>Ações</th>
</tr>
</thead>
<tbody>
<?php if (!empty($clientes)) : ?>
    <?php foreach($clientes as $cliente):{?>
        
    <tr>
        <td><img src="<?php echo (!empty($cliente['foto'])) ? '../fotos_clientes/'.$cliente['foto'] : './img/user.png'; ?>" alt="Foto do Cliente"></td>
        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
        <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
        <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
        <td>
            <a href="formCliente.php?id=<?php echo $cliente['idcliente']; ?>"><button class="btn btn-editar">Editar</button></a>
            <button class="btn btn-deletar" onclick="confirmarDeletar(<?php echo $cliente['idcliente']; ?>)">Deletar</button>
        </td>
    </tr>
    <?php } ?>
<?php else: ?>
<tr><td colspan="5">Nenhum cliente cadastrado.</td></tr>
<?php endif; ?>
</tbody>
</table>

</body>
</html>
