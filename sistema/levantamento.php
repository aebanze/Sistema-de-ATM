<?php
    #inicializando a session
    session_start();

    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }

    $nome = $_SESSION['nome'];


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
            <span class="lblName"><label for=""><?php echo "$nome" ?></label></span>
        </div>
    </header>
    <div class = "caixaL">
        <form action="levantar.php" method="POST">
            <div id="info">
                Informe o valor que pretende levantar
            </div>
            <div><input class="ipt" type="number" name="quantia" id="quantia" placeholder="min = 10"></div>

            <div><button type="submit" id="btnLv">Levantar</button></div>
        </form>
    </div>
        
    <footer>
        <div>
            <a href="pagina_inicial.php"><button class="btnbackLv">Voltar</button></a>
        </div>
        
    </footer>
</body>
</html>