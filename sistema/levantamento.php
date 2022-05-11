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
    <title>AEB Levantamento</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <div class = "caixa2">
            <div class = "btnPI">
                <button class = "btnI">200.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI">500.00 Mt</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI">1000.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI">1200.00 MT</button>
            </div>

            <div class = "btnPI">
                <button class = "btnI">1500.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI">2000.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI">3000.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI">OUTROS MONTANTES</button>
            </div>
    </div>
</body>
</html>