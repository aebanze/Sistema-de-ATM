<?php
    session_start();

    #incluindo arquivo de conexao a script
    require_once 'conexao.php';

    $endereco = ipusuario();
    
    #recebendo dados do formulario
    $p_nome = $_POST['usuario'];
    $p_senha = $_POST['senha'];


    #consultando usuario na base de dados
    $sql = "select username, password, id from cliente_log where username = '$p_nome' and password = '$p_senha'";

    $query = $con->prepare($sql);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $r = $query->fetch();

    $sql2 = "select cl_apelido from cliente where cl_cod = '$r[id]'";
    $query2= $con->prepare($sql2);
    $query2->execute();
    $query2->setFetchMode(PDO::FETCH_ASSOC);
    $r2 = $query2->fetch();

    if ($r['username'] === $p_nome && $r['password'] === $p_senha) {
        $_SESSION['dentro'] = true;
        $_SESSION['id'] = $r['id'];
        $_SESSION['nome'] = $r['username'];
        $_SESSION['apelido'] = $r2['cl_apelido'];
        header('location: pagina_inicial.php');
    } else {
        $query = "INSERT INTO `tentativas_login`(`endereco_ip`) VALUES ('$endereco')";
        $q = $con->prepare($query);
        $q->execute();
        header('location: index.php');
    }

    

    function ipusuario(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
?>