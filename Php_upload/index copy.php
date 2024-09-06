<?php

include('conexao.php');
//enviar para p banco de dados

if(isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo'];

    if($arquivo['error'])
        die("Falha ao enviar arquivo");

    if($arquivo['size'] > 20971520)
        die("Arquivo muito grande!! Max: 20MB");

    $pasta = "arquivos/"; 
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();  
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if($extensao != "jpg" && $extensao != 'png')
        die("Tipo de arquivo não aceito");

    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $pasta . $novoNomeDoArquivo . "." . $extensao);
        if($deu_certo){
            echo "<p>Arquivo enviado com sucesso! Para acessá-lo, <a target = \"_blank\" href= \"arquivos/$novoNomeDoArquivo.$extensao\">clique aqui. </a></p>";
        }else{
            echo "<p>Falha ao enviar arquivo!</p>";
        }
}       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivos</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="">]
        <!-- 2 -->
        <p><label for="arquivo">Selecione o arquivo</label>
        <input type="file" name="arquivo"></p> 
        <!-- 1 -->

        <button type="submit">Enviar Arquivo</button>
    </form>
</body>
</html>

<!-- Notas importantes:

1. Dar um 'name para o input;

2. Ajustar o 'form' para que tenha: 'form enctype="multipart/form-data"' e 'method="POST"'; -->
