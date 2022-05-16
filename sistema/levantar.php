<?php
    session_start();

    #incluindo arquivo de conexao a script
    require_once 'conexao.php';

    
    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }

    $sql = ("select saldo from conta where id_cliente = '$id'");
    $resgisto = $con->query($sql, PDO::FETCH_ASSOC);
    $res = $resgisto->fetch();

?>

<?php
    function levantar ($valor){
            
        $saldo = $res['saldo'] ?? NULL;
        $saldoF = $saldo - $valor;

        return $saldoF;
    }
?>

