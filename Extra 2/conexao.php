<?php

$hostname = 'localhost';
$user = 'root';
$password = '';
$database = 'aula';

$mysqli = new mysqli($hostname, $user, $password, $database);

if($mysqli->connect_errno) {
    die("Falha na conexao! (" . $mysqli->connect_errno . ")" . $mysqli->connect_error);
}

?>