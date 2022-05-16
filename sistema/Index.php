
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
        <form id="login" action="processamento.php" method="post" onsubmit="return validaForm()">
            <div class = "div">
                <span class = "lbl"><label for="usuario">Usuario</label></span>
                <span class = "ipt "><input type="text" name="usuario" id="user"></span>
            </div>
            <div class = "div">
                <span class = "lblS"><label for="senha">Senha</label></span>
                <span class = "ipt"><input type="password" name="senha" id="pass"></span>
            </div>
            <div>
                <button type="submit" class = "btn">Entrar</button>
            </div>
        </form>
    </div>

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