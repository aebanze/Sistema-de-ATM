<?php
    session_start();
    //controlando acesso
    $_SESSION['dentro'] = False;

    //pegando dados do usuario na pagina index.php
    $p_usuario = $_POST['usuario'] ?? NULL;
    $p_senha = $_POST['senha'] ?? NULL;

    
    //evitar ataques do tipo  sqlInjection
    $p_usuario = stripcslashes($p_usuario);
    $p_senha = stripcslashes($p_senha);
    $p_usuario = mysql_real_escape_string($p_usuario);
    $p_senha = mysql_real_escape_string($p_senha);

    //conexao a base de dados
    mysql_connect("localhost", "root", "");
    mysql_select_db("cliente_log");



    //pesquisa pelo usuario na base de dados
    $resultado = mysql_query ("select * from users where username = '$p_usuario' and password = '$p_senha'")
                or die ("dados incorrectos ".mysqli_error());
    
    $colunas = mysqli_fetch_array($resultado);

    if ($colunas['username'] == $p_usuario && $colunas['password'] == $p_senha) {
        header('location: pagina_inicial.php');
    } else {
        header ('location: index.php');
    }
    
?>
