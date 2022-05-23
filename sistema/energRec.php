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
    $ret = "";

    //pegando dados do formulario via post

    $contador = $_POST['contador'];
    $valor = $_POST['valor'];
    $_SESSION['credelec'] = $valor;
    $_SESSION['contador'] = $contador;

    $sql = "SELECT `contador_nr` FROM `conta_credelec` WHERE `contador_nr` = '$contador'";
    $query = $con->prepare($sql);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $r = $query->fetch();

    if ($r['contador_nr'] === $contador){
        $sql2 = "SELECT `saldo` FROM `conta` WHERE `id_cliente` = '$id'";
        $registo = $con->query($sql2, PDO::FETCH_ASSOC);
        $row = $registo->fetch();

        $saldoDis = $row['saldo'];

        if($saldoDis > ($valor + 10)){
            $saldoTotal = $saldoDis - ($valor + 10);
            $date = date("d") . "-" . date("m") . "-" . date("y");
            $act = "UPDATE `conta` SET `saldo`='$saldoTotal' WHERE `id_cliente` = '$id'";
            $inserir = $con->prepare($act);
            if($inserir->execute()){
                $codigo = codGen();
                $_SESSION['codigoCred'] = $codigo;
                $ret = "Efectuada a compra de credelec com sucesso no valor de 
                        $valor .00Mt. </br>  codigo: $codigo";
                $mov = $con->query("INSERT INTO `movimentos`(`actividade`, `descricao`, `custo`, `data`) VALUES ('Credelec','Compra de Credelec para contador $contador','$valor','$date') where `cliente_id` = '$id'", PDO::FETCH_ASSOC);
                $mov->execute();
            }
        } else {
            $ret = "Saldo insuficiente para efectuar a operação";
        }
    } else {
        $ret = "contador nao existe na base de dados";
    }
?>

<?php
    function codGen(){
        $part0 = rand(10, 99);
        $part1 = rand(10, 99);
        $part2 = rand(100, 999);
        $part3 = rand(1000, 9999);
        $part4 = rand(10000, 99999);
        
        $gen = $part0 . $part1 . $part2 . $part3 . $part4;
        return $gen;
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Recarga Credelec</title>
    <link rel="stylesheet" href="./css/estilo.css">

</head>
<body>

    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome" ?></label></span>
        </div>
    </header>

    <div class="rec">
        <?php echo "$ret"; ?>
    </div>

    <div>
        <a href="pdfEnerg.php"><button id="printEnerg">Imprimir</button></a>
    </div>
    <footer>
        <div>
            <a href="credelec.php"><button id="bckEnerg">Voltar</button></a>
        </div>
    </footer>
</body>
</html>