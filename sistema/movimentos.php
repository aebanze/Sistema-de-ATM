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
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Movimentos</title>
</head>
<body>
    
</body>
</html>