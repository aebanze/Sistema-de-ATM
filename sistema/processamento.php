<?php

    #incluindo arquivo de conexao a script
    require_once 'conexao.php';

    #recebendo dados do formulario
    $p_nome = $_POST['usuario'];
    $p_senha = $_POST['senha'];


    #consultando usuario na base de dados
    $sql = "select username, password from cliente_log where username = '$p_nome' and password = '$p_senha'";

    $query = $con->prepare($sql);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $r = $query->fetch();


    if ($r['username'] === $p_nome && $r['password'] === $p_senha) {
        header('location: pagina_inicial.php');
    } else {
        header('location: index.php');
    }
    
?>