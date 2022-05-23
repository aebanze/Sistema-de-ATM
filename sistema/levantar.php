<?php
    session_start();

    #incluindo arquivo de conexao a script
    require_once 'conexao.php';

    
    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }

    $id = $_SESSION['id'];
    $val = $_POST['quantia'];
    $nome = $_SESSION['nome'];
    $info = "";
    $_SESSION['quantiaLv'] = $val;

    $sql = ("select saldo from conta where id_cliente = '$id'");
    $resgisto = $con->query($sql, PDO::FETCH_ASSOC);
    $res = $resgisto->fetch();
    $saldo = $res['saldo'];

    if($saldo > ($val + 10)){
        $date = date("d") . "-" . date("m") . "-" . date("y");
        $rem = $saldo - ($val + 10);
        $sql2 = "UPDATE `conta` SET `saldo`='$rem' WHERE id_cliente = '$id'";
        $inserir = $con->prepare($sql2);

        if($inserir->execute()){
            $info = "Efectuou com sucesso o levantamento de $val .00MT";
        }

        $sql3 = "INSERT INTO `movimentos`(`actividade`, `descricao`, `custo`, `data`) VALUES ('Levantamento',Levantamento de dinheiro','$val','$date')";
        $mov = $con->prepare($sql3);
        $mov->execute();
        $mov->setFetchMode(PDO::FETCH_ASSOC);
    } else {
        $info = "Saldo insuficiente para a operação";
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


    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome" ?></label></span>
        </div>
    </header>
    
    <div>
        <?php echo "$info"; ?>
    </div>

    <div>
        <a href="pdfLv.php"><button id = "printLvr"></button></a>
    </div>
        
    <footer>
        <div>
            <a href="levantamento.php"><button id="btnbackLvr">Voltar</button></a>
        </div>
        
    </footer>
</body>
</html>

