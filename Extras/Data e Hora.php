<?php

/*echo time();

echo strtotime("1970-01-01");

echo date("d/m/Y",strtotime("1970-01-01"));*/

//Mostrar a data atual em timestamp;

echo "<p>Data Atual em timestamp: " . time() . "</p>";

//Transformar timestamp em data atual;

echo "<p>Data Atual em timestamp: " . date("d/m/y", time()) . "</p>";

//Transformar data atual em timestamp;

echo "<p>Data Atual em timestamp: " . strtotime("2021-02-05") . "</p>";

//Somar 100 dias em uma data;
$data = "2021-02-05";
$nova_data = strtotime($data) + (86400*100);
echo "<p>Data Atual em timestamp: " . time() . "</p>";

//Subtrair 10 dias em uma data;
$data = "2021-02-05";
$nova_data = strtotime($data) + (86400*100);
echo "<p>Data Atual em timestamp: " . time() . "</p>";

//Convertendo o timestamp pro banco de dados;

echo "<p>Data Atual em timestamp: " . time() . "</p>";

//Descobrir dia da semana de uma data;

echo "<p>Data Atual em timestamp: " . time() . "</p>";
