<?php
    session_start();

    #incluindo arquivo de conexao a script
    include 'conexao.php';
    $info = "";

    if (isset($_POST['submit'])){
        $tempo = time() - 10800;
        $endereco = ipusuario();
        $tentativa = $con->query("select count(*) as contagem from tentativas_login where tempo>$tempo and endereco_ip='$endereco'", PDO::FETCH_ASSOC);
        $r = $tentativa->fetch();
        $total = $r['contagem'];

        if ($total == 3){
            $info = "Usuario bloqueado. Tente de novo apos 3 horas";
        } else{
            #recebendo dados do formulario
            $p_nome = $_POST['usuario'];
            $p_senha = $_POST['senha'];

            #consultando dados do usuario na base de dados
            $sql = "select * from cliente where username = '$p_nome' and password = '$p_senha'";
            $query = $con->prepare($sql);
            $query->execute();
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $r = $query->fetch();

            //validando os dados
            if ($r['username'] === $p_nome && $r['password'] === $p_senha) {
                $_SESSION['dentro'] = true;
                $_SESSION['id'] = $r['cl_cod'];
                $_SESSION['nome'] = $r['cl_nome'] . " " . $r['cl_apelido'];
                $_SESSION['pass'] = $p_senha;
                //zerar as tentativas na base de dados
                $query2 = $con->query("delete from `tentativas_login` where `endereco_ip` = '$endereco'", PDO::FETCH_ASSOC);
                $query2->execute();
                header('location: pagina_inicial.php');
            } else {
                $total++;
                $remTotal = 3-$total;
                if($remTotal == 0){
                    $info = "Usuario bloqueado. Tente de novo apos 3 horas";
                } else {
                    $info = "Usuario ou senha invalida! </br> Mais $remTotal tentativas";
                }
                $tempoTentativa = time();
                $query = "INSERT INTO `tentativas_login`(`endereco_ip`, `tempo`) VALUES ('$endereco', '$tempoTentativa')";
                $q = $con->prepare($query);
                $q->execute();
            }
        }
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

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEB Bank</title>
    <link rel="stylesheet" href="./css/estilo.css">

</head>
<body>

    <div class = "caixa">
        <form id="login" action="" method="post" onsubmit="return validaForm()">
            <div class = "div">
                <span class = "lbl"><label for="usuario">Usuario</label></span>
                <span class = "ipt "><input type="text" name="usuario" id="user"></span>
            </div>
            <div class = "div">
                <span class = "lblS"><label for="senha">Senha</label></span>
                <span class = "ipt"><input type="password" name="senha" id="pass"></span>
            </div>
            <div>
                <button type="submit" class = "btn" name="submit">Entrar</button>
            </div>

        </form>
        
    </div>
    <div id="erro"> <?php echo $info; ?></div>

    <script lang="javascript">
        /**verificar se os campos estao preenchidos */
        function validaForm(){
            var usuario = document.getElementById('user')
            if(usuario.value == ""){
                alert("Preencha todos os campos sff!")
                usuario.focus();
                return false;
            }
            var senha = document.getElementById('pass')
            if(senha.value == ""){
                alert("Preencha todos os campos sff!")
                senha.focus();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>