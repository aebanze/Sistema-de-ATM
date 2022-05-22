<?php
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
    <title>AEB Credelec</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome" ?></label></span>
        </div>
    </header>

    <div class="caixa">
        <form action="energRec.php" method="POST">
            <div>
                <p>Introduza o Nº do Contador</p>
                <span><input class="ipt" type="text" name="contador" id="contador"></span>
            </div>
            <div>
                <p>Introduza o Montante</p>
                <span><input class="ipt" type="number" name="valor" id="valor" min = "10" placeholder="min = 10"></span>
            </div>
            <div>
                <button type="submit" class="btnCr">Comprar</button>
            </div>
        </form>
    </div>

    <footer>
        <div>
            <a href="servicos.php"><button class="backCr">Voltar</button></a>
        </div>
    </footer>
</body>
</html>