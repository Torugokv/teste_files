<?php

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
                    // 28/02/1994
                    //Array(28,08,1994)
                    $pedacos = implode ('-', array_reverse(explode ('/' , $nascimento)));
                    $nascimento = "";
                }else{
                    echo "A data de nascimento deve seguir o padrão dia/mes/ano.";
                }
            }
            if(!empty($telephone)) {
                $telephone = limpar_texto($telefone);
                if(strlen($telefone) != 11)
                    $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
            }
        }
        if ($erro){
            echo "<p><b>ERRO: $erro</b></p>";
            }else{
                $sql_code = "INSERT INTO clientes(nome, email, telefone, nascimento, data)
                VALUES ('$nome', '$email', '$telefone', $nascimento', NOW())";
                $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
                if($deu_certo){
                    echo "<p>Cliente cadastrado com sucesso!!</p>";
                }
        }
?>