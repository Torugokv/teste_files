<?php

// Conexão ao banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$bd = "upload";

$mysqli = new mysqli($host, $user, $pass, $bd);

if ($mysqli->connect_errno) {
    die("Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// Consulta SQL para obter a lista de arquivos
$sql = "SELECT nome, path, data_upload FROM arquivos";
$sql_query = $mysqli->query($sql);

if (!$sql_query) {
    die("Erro na consulta: (" . $mysqli->errno . ") " . $mysqli->error);
}
?>