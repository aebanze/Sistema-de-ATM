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
    $apelido = $_SESSION['apelido'];
    $id = $_SESSION['id'];

    $query = "SELECT  `saldo` FROM `conta` WHERE id_cliente = '$id'";
    $registo = $con->query($query, PDO::FETCH_ASSOC);
    $res = $registo->fetch();

    $saldo = $res['saldo'];

    

    //pegando dados do formulario
    $numero = $_POST['numero'];
    $quantia = $_POST['montante'];

    $total = $saldo - ($quantia + 10);
    $recarga = recargaPrint($numero, $quantia);
    $sql = "UPDATE `conta` SET `saldo`='$total' WHERE id_cliente = '$id'";
    $inserir = $con->prepare($sql);
    $inserir->execute();

?>

<?php

    function verificarNr($nr){
    
        $numero = str_split($nr);
        $tamanho = count($numero);

        if ($tamanho == 9) {
            if ($numero[0] == 8) {
                if ($numero[1] == 4 || $numero[1] == 5) {
                    $info = "VODACOM";
                } else if ($numero[1] == 2 || $numero[1] == 3){
                    $info = "TMCEL";
                } else if ($numero[1] == 6 || $numero[1] == 7) {
                    $info = "MOVITEL";
                } else {
                    $info = "Nº inválido";
                }
                
            } else {
                $info = "Nº inválido";
            }
        } else {
            $info = "Nº inválido";
        }
        return $info;
}

    function recargaGen (){
        $rec1 = rand(0, 9);
        $rec2 = rand(10000, 99999);
        $rec3 = rand(100, 999);
        $rec4 = rand(100, 999);

        $codigo = $rec1 . $rec2 . $rec3 . $rec4;
        
        return $codigo;
}

    function recargaPrint($nr, $valor){
        $info = "";
        if (!empty($nr)) {
            if (!empty($valor)) {
                $operadora = verificarNr($nr);
                if ($operadora !== "Nº inválido") {
                    $codigoRec = recargaGen();
                    
                    $info = "Efectuada a compra da recarga $operadora no valor de $valor 00. MT
                    para o numero $nr com sucesso. custo de 10.00 MT </br> codigo da recarga: $codigoRec";
                } else {
                    $info = "Nº inválido";
                }
                
                
            } else {
                $info = "Informe o valor da recarga sff";
            }
            
        } else {
            $info = "Introduza um numero sff";
        }
        echo $info;
    }
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Recarga</title>

</head>
<body>
    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome $apelido" ?></label></span>
        </div>
    </header>

    <p><?php echo $recarga; ?></p>
</body>
</html>