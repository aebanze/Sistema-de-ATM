<?php
    session_start();

    
    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }

    
    $nome = $_SESSION['nome'];
    $apelido = $_SESSION['apelido'];

    //pegando dados do formulario
    $numero = $_POST['numero'] ?? NULL;
    $quantia = $_POST['montante'] ?? NULL;



?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Recargas</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome $apelido" ?></label></span>
        </div>
    </header>

    <div class="caixa">
        <form action="recarga.php" method="POST">
            <p>Introduza o numero de Celular</p>
            <div>
                <input class="ipt" type="text" name="numero" id="numero" required>
            </div>
            
            <div>
                <p>informe o valor da recarga</p>
                <input class="ipt" type="number" name="montante" id="montante" placeholder="min = 10">
            </div>
            <div  style="margin-top: 20px;">
                <button type="submit" class = "btn2">Comprar</button>
            </div>
        </form>
    </div>

    <footer>
        <div>
            <a href="servicos.php"><button class="btnbackCR">Voltar</button></a>
        </div>
    </footer>

    
</body>
</html>