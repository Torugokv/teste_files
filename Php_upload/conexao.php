<?php

$host = "localhost";
$bd = "arquivos";
$user = "root";
$pass = "";

$mysqli = new mysqli($host, $bd, $user, $pass);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error; 
} else{
    echo "Conectado!";
}
