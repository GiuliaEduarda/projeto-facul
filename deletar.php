<?php
include 'config.php';

$id_lista = $_GET['id'];

$sql = "DELETE FROM listas WHERE id_listas=$id_lista";

if ($conexao->query($sql) === TRUE) {
    header('Location: minhaslistas.php');
    
} else {
    echo "Erro: " . $sql . "<br>" . $conexao->error;
}

$conexao->close();
?>
