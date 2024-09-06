<?php

require_once('lib/conexao.php');

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario']))
    die('Você não está logado. <a href="index.php>Clique Aqui</a> para logar"');

if(isset($_POST['email'])) {

    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query = "INSERT INTO senhas (email, senha) VALUES ('$email', '$senha')";
    if ($mysqli->query($query) === TRUE) {
        echo "Registro inserido com sucesso!";
    } else {
        echo "Erro: " . $mysqli->error;
    }

}
$id = $_SESSION['usuario'];
$sql_query = $mysqli->query("SELECT * FROM senhas WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ya</title>
</head>
<body>
    <p>Bem Vindo, <?php echo $usuario['nome']?></p>
    <br>
    Cadastrar Senha
    <br>
    <form action ="" method="POST">
        <input type ="text" name ="email"><br>
        <input type ="password" name ="senha"><br> 
        <button type ="submit">Cadastrar Senha</button>
    </form>
    <p><a href = "logout.php">Sair</a></p>
</body>
</html>
