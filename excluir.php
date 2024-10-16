<?php
require_once 'config.php'; // Inclui a conexão com o banco de dados

// Verifica se o ID do item a ser excluído foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Obtém o ID do item de forma segura

    // Prepara a consulta de exclusão
    $query = "DELETE FROM itens WHERE id = $id";

    // Executa a consulta de exclusão
    if (mysqli_query($conexao, $query)) {
        // Se a exclusão for bem-sucedida, atualiza os IDs dos itens restantes
        $update_query = "SET @new_id = 0; 
                         UPDATE itens SET id = (@new_id := @new_id + 1) ORDER BY id;";
        mysqli_multi_query($conexao, $update_query);

        // Redireciona para a página de produtos após a exclusão
        header("Location: produtos.php");
        exit(); // Encerra a execução após o redirecionamento
    } else {
        echo "Erro ao excluir item: " . mysqli_error($conexao);
    }
} else {
    echo "ID do item não fornecido.";
}

// Fecha a conexão
mysqli_close($conexao);
?>



<!-- ------------------------------------------------------------------------------------------------------------------------- -->

<?php
ob_start();
require_once 'config.php';

// Obtém o ID da lista e o nome da lista da URL
$id_lista = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nome_lista = isset($_GET['nome_lista']) ? htmlspecialchars($_GET['nome_lista']) : '';

// Debug: Verifica se as variáveis estão recebendo valores
if ($id_lista === 0) {
    echo "ID da lista não fornecido ou inválido.";
    exit();
}
if (empty($nome_lista)) {
    echo "Nome da lista não fornecido.";
    exit();
}

// Verifica se o formulário foi submetido para adicionar item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nome_item = $_POST['nome'];

    // Prepara e executa a consulta para inserir um novo item
    $query_insert = "INSERT INTO itens (nome, comprado, id_lista) VALUES ('$nome_item', 0, '$id_lista')";
    if (mysqli_query($conexao, $query_insert)) {
        // Redireciona para evitar o reenvio do formulário
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id_lista . "&nome_lista=" . urlencode($nome_lista));
        exit();
    } else {
        echo "<div class='alert alert-danger'>Erro ao adicionar item: " . mysqli_error($conexao) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas listas - <?php echo $nome_lista; ?></title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/produtos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4533a4cadf.js" crossorigin="anonymous"></script>
    <style>
        tbody tr:nth-child(odd) {
            background-color: #644989;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bd-light shadow p-3">
        <div class="container-fluid ">
            <button class="navbar-toggler" type="button" data-toggle="modal" data-target="#exampleModal">
                <span class="navbar-toggler-icon fa-lg"></span>
            </button>
            <div class="mobile-hide collapse navbar-collapse justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="minhaslistas.php">Minhas listas</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Contatos</a></li>
                </ul>
                <ul class="navbar-nav nav-img d-none d-lg-block">
                    <li class="nav-item d-none d-lg-block "><img src="img/Listou___1_-removebg-preview.png" width="60" alt=""></li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item "><a class="btn btn-outline-light" href="minhaconta.php"><i class="fa-regular fa-circle-user fa-lg mr-2"></i>Minha conta</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="sair.php" >Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="lista" style="margin-top: 2rem;">
        <h1 style="color: white;"><?php echo $nome_lista; ?></h1>
    </div>

    <div class="container tra mt-5">
        <?php
        // Consulta para selecionar todos os itens da tabela 'itens' para a lista específica
        $query = "SELECT * FROM itens WHERE id_lista = '$id_lista'";
        $result = mysqli_query($conexao, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-bordered'><tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td id='che'>
                                <span class='item-nome'>" . $row['nome'] . "</span>
                            </td>
                            <td>
                              <div class='final'>
                                  <div class='d-flex lixo'>
                                      <a href='#' class='delete-item' data-id='" . $row['id'] . "'><i class='fa-solid fa-trash-can fa-2x mr-2'></i></a>
                                  </div>
                                  <div class='d-flex justify-content-center align-items-center'>
                                    <input type='checkbox' class='btn-check' autocomplete='off' name='comprado' value='1' 
                                           data-id='" . $row['id'] . "' " . ($row['comprado'] ? "checked" : "") . ">
                                  </div>
                              </div>
                            </td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='text-center'>Nenhum item encontrado.</p>";
            }
        } else {
            echo "<div class='alert alert-danger'>Erro ao buscar itens: " . mysqli_error($conexao) . "</div>";
        }
        ?>

        <div class="add text-center">
            <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $id_lista . "&nome_lista=" . urlencode($nome_lista); ?>" method="post">
                <div class="form-group mr-2 row">
                    <input type="text" id="nome" name="nome" class="form-control form-control-lg col" required placeholder="Digite o nome do item...">
                    <button type="submit" id="botaoadicionar" name="submit" class="btn col-3">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Evento para detectar mudanças no checkbox
        $('input[name="comprado"]').on('change', function() {
            var itemId = $(this).data('id');
            var comprado = $(this).is(':checked') ? 1 : 0;
            
            // Envia uma requisição AJAX para atualizar o status do item
            $.ajax({
                url: 'update_item.php',
                method: 'POST',
                data: {
                    item_id: itemId,
                    comprado: comprado
                },
                success: function(response) {
                    console.log('Item atualizado com sucesso');
                },
                error: function() {
                    console.log('Erro ao atualizar item');
                }
            });
        });

        // Evento para excluir item
        $('.delete-item').on('click', function(e) {
    e.preventDefault(); // Evita o redirecionamento padrão do link
    var itemId = $(this).data('id');
    var row = $(this).closest('tr'); // Guarda a linha para remoção

    // Envia uma requisição AJAX para excluir o item sem confirmação
    $.ajax({
        url: 'delete_item.php', // URL do script que processa a exclusão
        method: 'POST',
        data: {
            item_id: itemId
        },
        success: function(response) {
            console.log('Item excluído com sucesso');
            row.remove(); // Remove a linha da tabela
        },
        error: function() {
            console.log('Erro ao excluir item');
        }
    });
});

    });
</script>
</body>
</html>
