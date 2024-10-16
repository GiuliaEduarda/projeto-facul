<?php
require_once 'config.php';

if (isset($_POST['item_id']) && isset($_POST['comprado'])) {
    $id = intval($_POST['item_id']);
    $comprado = intval($_POST['comprado']);

    $update_query = "UPDATE itens SET comprado = '$comprado' WHERE id = $id";
    if (mysqli_query($conexao, $update_query)) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conexao);
    }
}

mysqli_close($conexao);
?>
