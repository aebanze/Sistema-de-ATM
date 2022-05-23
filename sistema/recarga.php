<?php
    session_start();

    //incluir arquivo de conexao
    require_once 'conexao.php';
    
    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }

    
    $nome = $_SESSION['nome'];
    $id = $_SESSION['id'];

    $query = "SELECT  `saldo` FROM `conta` WHERE id_cliente = '$id'";
    $registo = $con->query($query, PDO::FETCH_ASSOC);
    $res = $registo->fetch();

    $saldo = $res['saldo'];


    

    //pegando dados do formulario
    $operadora = $_POST['operadora'];
    $quantia = $_POST['montante'];

    if ($saldo > ($quantia + 10)){
        $date = date("d") . "-" . date("m") . "-" . date("y");
        $total = $saldo - ($quantia + 10);
        $recarga = recargaGen();
        $_SESSION['credito'] = $quantia;
        $_SESSION['recarga'] = $recarga;
        $_SESSION['operadora'] = $operadora;
        
        $sql = "UPDATE `conta` SET `saldo`='$total' WHERE id_cliente = '$id'";
        $inserir = $con->prepare($sql);
        if($inserir->execute()){
            $info = "Efectuou com sucesso a compra da recarga de $quantia .00Mt 
                 $operadora. </br> Codigo da recarga: $recarga";
        }

        $mov = $con->query("INSERT INTO `movimentos`(`actividade`, `descricao`, `custo`, `data`) VALUES ('Credito','Compra de Credito $operadora','$quantia','$date') where `cliente_id` = '$id'", PDO::FETCH_ASSOC);
        $mov->execute();
        
    } else{
        $info = "Saldo insuficiente para efectuar a operação";
    }
?>

<?php

    function recargaGen (){
        $rec1 = rand(0, 9);
        $rec2 = rand(10000, 99999);
        $rec3 = rand(100, 999);
        $rec4 = rand(100, 999);

        $codigo = $rec1 . $rec2 . $rec3 . $rec4;
        
        return $codigo;
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Recarga</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome" ?></label></span>
        </div>
    </header>

    <div class="rec">

            <?php echo "$$info"; ?>

    </div>

    <div >
        <a href="pdfCredito.php"><button id="btnPrintCred">Imprimir</button></a>
    </div>


    <footer>
        <div>
            <a href="servicos.php"><button class="bckRec">Voltar</button></a>
        </div>
    </footer>
</body>
</html>