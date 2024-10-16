<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['email'])) {
        die("Você precisa estar logado para criar uma lista.");
    }

    $email = $_SESSION['email'];
    $nome_lista = $_POST['nome_lista'];

    $sql = "INSERT INTO listas (nome_lista, email) VALUES ('$nome_lista', '$email')";

    if ($conexao->query($sql) === TRUE) {
        header('Location: minhaslistas.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }

    $conexao->close();
}
?>

