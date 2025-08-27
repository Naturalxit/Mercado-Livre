<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Clickaê Login</title>
</head>
<body>
    <div class="centro">
        <div class="caixa">
            <h1>Clickaê Login</h1>
            <form action="verificarLogin.php" method="post">
                E-mail: <br>
                <input type="email" name="email"> <br><br>
                Senha: <br>
                <input type="password" name="senha"> <br><br>
                    <div class="acesso">
                <a href="formUsuario.php">Primeiro acesso</a> <br><br>
                    </div>
                    <div class="botao">
                        <input type="submit" value="Acessar" class="botao">
 
                    </div>      
            </form>
        </div>
    </div>
</body>
</html>
