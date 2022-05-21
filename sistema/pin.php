<?php
    session_start();

    #incluindo arquivo de conexao a script
    require_once 'conexao.php';

     #verificando se usuario esta logado ou nao
     if(!isset($_SESSION['dentro']) && $_SESSION["dentro"] !== true){
        header("location: index.php");
        exit;
    }

    $nome = $_SESSION['nome'];
    $apelido = $_SESSION['apelido'];
?>

<?php

    //pegando os dados do formulario
    $pinNovo = $_POST['novo'];
    $id = $_SESSION['id'];

    $sql = "UPDATE `cliente_log` SET `password`= '$pinNovo' WHERE id = '$id';";
    $query = $con->prepare($sql);
    $query->execute();

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB PIN</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <header>
        <div class="lbln">
            <span class="lblName"><label for=""><?php echo "$nome $apelido" ?></label></span>
        </div>
    </header>

    <div class="caixa">
        <form action="pin.php" method="post" onsubmit="return valida()">
            <p>Introduza o pin novo</p>
            <div>
                <input type="text" name="novo" class="ipt" id="novo">
            </div>
            <p>confirme o pin novo</p>
            <div>
                <input type="text" name="novoConf" class="ipt" id="novoConf">
            </div>
            <div>
                <button type="submit" class="btnTroca">Trocar</button>
            </div>
        </form>
    </div>
    <footer>
        <div>
            <a href="servicos.php"><button class="bck">Voltar</button></a>
        </div>
    </footer>

    <script lang = "javascript">
        
        function valida(){
            var novo = document.getElementById('novo')
            var novoConf = document.getElementById('novoConf')

            //verificar se todos os campos estao preenchidos
            if(antigo.value === "" || novo.value === "" || novoConf.value === ""){
                alert("Preencha todos os campos sff")
                return false;
            }

            //verificar se o pin novo bate com a confirmacao
            if (novo.value !== novoConf.value){
                alert("As senhas não coincidem")
                novoConf.innerHTML = "";
                return false;
            }
            return true;
        }
        
    </script>
</body>
</html>