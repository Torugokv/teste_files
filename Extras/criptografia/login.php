<?php
if(isset($_POST['email'])){
    
    require_once('conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $sql_code = "SELECT * FROM senhas WHERE email = '$email' LIMIT 1";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

    $usuario = $sql_exec->fetch_assoc();
    if(password_verify($senha, $usuario['senha'])) {
       if(!isset($_SESSION))
            session_start();
        $_SESSION['usuario'] = $usuario['id'];
        header("Location: index.php");
    } else {
        echo "Falha ao logar! Senha ou e-mail incorretos!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    Login de senha
    <form action="" method="POST">
        <input type="text" name="email"><br>
        <input type="text" name="senha"><br>
        <button type="submit">LOGAR</button>

    </form>
<!-- Não usar md5 ou base64 -->
</body>
</html>
