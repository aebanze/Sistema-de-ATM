
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Bank</title>
    <link rel="stylesheet" href="./css/estilo.css">

</head>
<body>

    <div class = "caixa">
        <form action="processamento.php" method="post">
            <div class = "div">
                <span class = "lbl"><label for="usuario">Usuario</label></span>
                <span class = "ipt "><input type="text" name="usuario" id="usuario"></span>
            </div>
            <div class = "div">
                <span class = "lblS"><label for="senha">Senha</label></span>
                <span class = "ipt"><input type="password" name="senha" id="senha"></span>
            </div>
            <div>
                <button type="submit" class = "btn">Entrar</button>
            </div>
        </form>
    </div>
</body>
</html>