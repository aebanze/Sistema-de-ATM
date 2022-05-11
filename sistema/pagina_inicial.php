<?php
    #inicializando a session
    session_start();

    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Paginal Inicial</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
    <div class = "caixa">
        <div class = "btnPI">
            <a href="levantamento.php"><button class = "btnI">Levantamento</button></a>
        </div>
        <div class = "btnPI">
            <a href="consulta.php"><button class = "btnI">Consultar Saldo</button></a>
        </div>
        <div class = "btnPI">
            <a href="pagamentos.php"><button class = "btnI">Pagamentos</button></a>
        </div>
        <div class = "btnPI">
            <a href="movimentos.php"><button class = "btnI">Movimentos</button></a>
        </div>
    </div>
        
</body>
</html>