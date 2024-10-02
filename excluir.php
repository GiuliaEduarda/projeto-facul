<?php
require_once 'config.php'; // Inclui a conexão com o banco de dados

// Verifica se o ID do item a ser excluído foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Obtém o ID do item

    // Prepara a consulta de exclusão
    $query = "DELETE FROM itens WHERE id = $id";

    // Executa a consulta
    if (mysqli_query($conn, $query)) {
        // Se a exclusão for bem-sucedida, atualiza os IDs dos itens restantes
        $update_query = "SET @new_id = 0; 
                         UPDATE itens SET id = (@new_id := @new_id + 1) ORDER BY id;";

        mysqli_multi_query($conn, $update_query);
        
        // Redireciona para a página de produtos
        header("Location: produtos.php");
        exit(); // Termina a execução do script após o redirecionamento
    } else {
        echo "Erro ao excluir item: " . mysqli_error($conn);
    }
} else {
    echo "ID do item não fornecido.";
}

// Fecha a conexão
mysqli_close($conn);
?>
