<?php
    //inicializacao da session
    session_start();

    //remocao de todas as variaveis na session
    $_SESSION = array();

    //destruicao da session
    session_destroy();

    //redirecionando o usuario para a pagina de login
    header('location:index.php');
    exit;
?>