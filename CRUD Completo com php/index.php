<?php

function limpar_texto($str){    
    return preg_replace("/[^0-9]/", "", $str); 
}

$erro = false;
if(count($_POST) > 0) {

    include('conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];

    if(empty($nome)){
        $erro = "Preencha o nome";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erro = "Preencha o e-mail";
    }
    if($erro){
        echo "<p><b>ERRO: $erro</b></p>";
    } else {
        if(!empty($nascimento)){
            $pedacos = explode ('/', $nascimento);
        }else{
            echo "A data de nascimento deve seguir o padrão dia/mes/ano.";
        }
    }
    if(!empty($telephone)) {
        $telephone = limpar_texto($telefone);
        if(strlen($telefone) != 11)
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }
    if ($erro){
        echo "<p><b>ERRO: $erro</b></p>";
        }else{
            $sql_code = "INSERT INTO clientes (nome, email, telefone, nascimento, data)
            VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";
            $deu_certo = $mysqli->query($sql_code) or die ($mysqli->error);
            if($deu_certo){
                echo "<p>Cliente cadastrado com sucesso!!</p>";
            }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <a href = "clientes.php">Voltar para a lista</a>
    <form action="" method ="POST">
        <p>
            <label>Nome:</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name = "nome" type = "text"><br>
        </p>
        <p>
            <label>E-mail:</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name = "email" type= "text"><br>
        </p>
        <p>
            <label>Telefone:</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>" placeholder ="(88) 98888-8888" name = "telefone" type= "text"><br>
        </p>
        <p>
            <label>Data de Nascimento:</label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" name = "nascimento" type= "text"><br>
        </p>
        <p>
            <button type="submit">Enviar formulário</button>
        </p>
    </form>
</body>
</html>