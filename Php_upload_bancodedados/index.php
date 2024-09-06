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

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
        if($deu_certo){
            $mysqli->query("INSERT INTO arquivos (nome, path) VALUES('$nomeDoArquivo', '$path')") or die ($mysqli->error);
            echo "<p>Arquivo enviado com sucesso!</p>";
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
    <form enctype="multipart/form-data" method="POST" action="">
        <!-- 2 -->
        <p><label for="arquivo">Selecione o arquivo</label>
        <input type="file" name="arquivo"></p> 
        <!-- 1 -->

        <button type="submit">Enviar Arquivo</button>
    </form>

<h1>Lista de Arquivos</h1>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Preview</th>
            <th>Arquivo</th>
            <th>Data de envio</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($arquivo = $sql_query->fetch_assoc()) {
        ?>
            <tr>
                <td><img height="50" src="<?php echo $arquivo['path']; ?>" alt=""></td>
                <td><a target="_blank" href="<?php echo $arquivo['path']; ?>"><?php echo $arquivo['nome']; ?></a></td>
                <td><?php echo date("d/m/Y H:i", strtotime($arquivo['data_upload']))?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

    

</body>
</html>

<!-- Notas importantes:

1. Dar um 'name para o input;

2. Ajustar o 'form' para que tenha: 'form enctype="multipart/form-data"' e 'method="POST"'; -->

