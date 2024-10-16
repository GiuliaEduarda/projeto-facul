<?php
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: index.php');
    exit();
}

include 'config.php';

if (isset($_GET['id'])) {
    $id_lista = intval($_GET['id']); // Garantindo que o ID seja um inteiro

    // Preparar e executar a consulta de exclusão
    $sql = "DELETE FROM listas WHERE id_listas = ?";
    $stmt = $conexao->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('i', $id_lista);
        if ($stmt->execute()) {
            // Sucesso na deleção
            header('Location: minhaslistas.php?message=Lista deletada com sucesso');
            exit();
        } else {
            // Erro na deleção
            header('Location: minhaslistas.php?error=Erro ao deletar lista');
            exit();
        }
    } else {
        // Erro ao preparar a consulta
        header('Location: minhaslistas.php?error=Erro ao preparar consulta');
        exit();
    }
} else {
    header('Location: minhaslistas.php');
    exit();
}
?>
