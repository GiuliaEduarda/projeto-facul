<?php

$dbHost = 'Localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'listou';



$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


mysqli_set_charset($conexao, "utf8");


?>

