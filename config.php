<?php

$dbHost = 'Localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'listou';



$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


mysqli_set_charset($conexao, "utf8");


?>

<?php
// config.php

// Set database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "compras";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>