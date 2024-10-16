<?php
require_once 'config.php'; // Carrega a configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Prepara e executa a consulta para excluir o item
    $query_delete = "DELETE FROM itens WHERE id = $item_id";
    if (mysqli_query($conexao, $query_delete)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conexao)]);
    }
}
?>