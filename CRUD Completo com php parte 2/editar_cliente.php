<?php

include('conexao.php');
$id = intval($_GET['id']);

function limpar_texto($str){    
    return preg_replace("/[^0-9]/", "", $str); 
}

$erro = false;
if(count($_POST) > 0) {

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
            if(count ($tmp) == 3){
                $nascimento = implode ('-', array_reverse($pedacos));
            }
        }else{
            echo "A data de nascimento deve seguir o padrão dia/mes/ano.";
        }
    }
    if(!empty($telephone)) {
        $telephone = limpar_texto($telefone);
        if(strlen($telefone) >= 11)
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }
    if ($erro){
        echo "<p><b>ERRO: $erro</b></p>";
        }else{
            $sql_code = "UPDATE clientes
            SET nome = '$nome',
            email = '$email',
            telefone = '$telefone',
            nascimento = '$nascimento'
            WHERE id = '$id'";
            $deu_certo = $mysqli->query($sql_code) or die ($mysqli->error);
            if($deu_certo){
                echo "<p>Cliente atualizado com sucesso!!</p>";
                unset($_POST);
            }
    }
}

$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <a href = "clientes.php">Voltar para a lista</a>
    <form action="" method ="POST">
        <p>
            <label>Nome:</label>
            <input value="<?php echo $cliente['nome']; ?>" name = "nome" type = "text"><br>
        </p>
        <p>
            <label>E-mail:</label>
            <input value="<?php echo $cliente['email']; ?>" name = "email" type= "text"><br>
        </p>
        <p>
            <label>Telefone:</label>
            <input value="<?php echo formatar_telefone ($cliente['telefone']); ?>" placeholder ="(88) 98888-8888" name = "telefone" type= "text"><br>
        </p>
        <p>
            <label>Data de Nascimento:</label>
            <input value="<?php echo formatar_data ($clientes['nascimento']); ?>" name = "nascimento" type= "text"><br>
        </p>
        <p>
            <button type="submit">Enviar formulário</button>
        </p>
    </form>
</body>
</html>