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
    <title>AEB Pagamentos</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome" ?></label></span>
        </div>
    </header>

    <div class="caixaL">
        <span><a href="credelec.php"><button class = "btnS">Credelec</button></a></span>
        <span><a href="credito.php"><button class = "btnS">Credito</button></a></span>
    </div>
    <div class="caixaR">
        <span><a href="pin.php"><button class="btnPin">Alterar PIN</button></a></span>
    </div>
  
    <footer>
        <div>
            <a href="pagina_inicial.php"><button class="btnback">Voltar</button></a>
        </div>
    </footer>
</body>
</html>