<?php
    #inicializando a session
    session_start();

    #incluir arquivo de conexao a base de dados
    include ('conexao.php');

    #verificando se usuario esta logado ou nao
    if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }
    //pegar o nome e apelido do usuario para mostrar na tela
    $nome = $_SESSION['nome'];
    $id = $_SESSION['id'];

?>

<?php
    //consulta de saldo do usuario na BD
    $query = ("select saldo from conta where id_cliente = '$id'");
    $resgisto = $con->query($query, PDO::FETCH_ASSOC);
    $res = $resgisto->fetch();

    $saldo = $res['saldo'];
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Consulta</title>
    <link rel="stylesheet" href="./css/estilo.css">
    
</head>
<body>
    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome" ?></label></span>
        </div>
    </header>
    <div class="tblconsuta">
        <table id="tbl1" border="solid 1px radius">
            <tr>
                <td>
                    Saldo Disponivel
                </td>
                <td>
                    <?php
                        echo "$saldo .00MT";
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <a href="pdfSaldo.php"><button id="btnPrintSal">Imprimir</button></a>
    </div>
    <footer>
        <div>
            <a href="pagina_inicial.php"><button class="btnbackcon">Voltar</button></a>
        </div>
    </footer>
</body>
</html>