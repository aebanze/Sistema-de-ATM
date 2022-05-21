<?php
    #inicializando a session
    session_start();

    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }

    $nome = $_SESSION['nome'];
    $apelido = $_SESSION['apelido'];

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


    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome $apelido" ?></label></span>
        </div>
    </header>
    <div class = "caixa2">
        <span class="subcaixa">
            <div class = "btnPI">
                <button class = "btnI" value="200">200.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI" value="500">500.00 Mt</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI" value="1000">1000.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI" value="1200">1200.00 MT</button>
            </div>
        </span>
        <span class="subcaixa">
            <div class = "btnPI">
                <button class = "btnI" value="1500">1500.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI" value="2000">2000.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI" value="3000">3000.00 MT</button>
            </div>
            <div class = "btnPI">
                <button class = "btnI">OUTROS MONTANTES</button>
            </div>
        </span>
    </div>

    <script>

    </script>
    <footer>
        <div>
            <a href="pagina_inicial.php"><button class="btnbackLv">Voltar</button></a>
        </div>
    </footer>
</body>
</html>