<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_lista = $_POST['id_listas'];
    $nome_lista = $_POST['nome_lista'];

    // Conexão com o banco de dados
    $conexao = new mysqli("localhost", "root", "", "listou");

    // Verificar conexão
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Atualizar o nome da lista
    $sql = "UPDATE listas SET nome_lista=? WHERE id_listas=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $nome_lista, $id_lista);

    if ($stmt->execute()) {
        header('Location: minhaslistas.php');
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }

    $stmt->close();
    $conexao->close();
}
?>

 


