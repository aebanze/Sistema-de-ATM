<?php
    session_start();
    $_SESSION['dentro'] = False;

    $usuario = '1247854687122';
    $senha = '1111';

    $p_usuario = $_POST['usuario'] ?? NULL;
    $p_senha = $_POST['senha'] ?? NULL;

    if ($p_usuario == $usuario && $p_senha == $senha) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        $_SESSION['dentro'] = True;
    }
?>

<?php
    if ($_SESSION['dentro'] == True) {
        header("Location: pagina_inicial.php");
    } else{
        header("Location: index.php");
        echo ('Usuario ou senha invalida');
    }
?>
