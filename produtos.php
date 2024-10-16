<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: index.php');
    exit();
}

require_once 'config.php';

// Verificação do ID da lista
if (isset($_GET['id'])) {
    $id = $conexao->real_escape_string($_GET['id']);
    $query = "SELECT nome_lista FROM listas WHERE id_listas = $id";
    $result = mysqli_query($conexao, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nome_lista = htmlspecialchars($row['nome_lista']);
    } else {
        $nome_lista = "Lista não encontrada";
    }
} else {
    $nome_lista = "ID da lista não fornecido";
}

// Verifica se o formulário foi submetido para adicionar item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nome_item = $conexao->real_escape_string($_POST['nome']);
    $query_insert = "INSERT INTO itens (nome, comprado, id_lista) VALUES ('$nome_item', 0, $id)";
    if (mysqli_query($conexao, $query_insert)) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=$id");
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
    <title><?php echo htmlspecialchars($nome_lista); ?></title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/produtos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4533a4cadf.js" crossorigin="anonymous"></script>
    <style>
        tbody tr:nth-child(odd) { background-color: #644989; color: white; }
        tbody tr:nth-child(even) { background-color: white; color: black; }
        .edit-container { display: none; }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bd-light shadow p-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="modal" data-target="#exampleModal">
                <span class="navbar-toggler-icon fa-lg"></span>
            </button>
            <div class="mobile-hide collapse navbar-collapse justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="minhaslistas.php">Minhas listas</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Contatos</a></li>
                </ul>
                <ul class="navbar-nav nav-img d-none d-lg-block">
                    <li class="nav-item d-none d-lg-block"><img src="img/Listou___1_-removebg-preview.png" width="60" alt=""></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="btn btn-outline-light" href="minhaconta.php"><i class="fa-regular fa-circle-user fa-lg mr-2"></i>Minha conta</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog w-100" role="document">
            <div class="modal-content pt-2 justify-content-between">
                <div class="modal-header d-flex">
                    <div id="conta2" class="mr-1 row btn btn-light">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="btn btn-outline-light" href="minhaconta.php"><i class="fa-regular fa-circle-user fa-lg mr-2"></i>Minha conta</a></li>
                        </ul>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="ho modal-line"><a class="nav-link" href="minhaslistas.php">Minhas listas</a></div>
                    <div class="ho modal-line"><a class="nav-link" href="">Contatos</a></div>
                    <div class="ho modal-line"><a class="nav-link" href="sair.php">Sair</a></div>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="lista" style="margin-top: 2rem;">
        <h1 style="color: white;"><?php echo $nome_lista; ?></h1>
    </div>
    <div class="container tra mt-5">
        <?php
        // Filtrar produtos pela lista correta
        $query = "SELECT * FROM itens WHERE id_lista = $id";
        $result = mysqli_query($conexao, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered'><tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td id='che'><span class='item-nome'>" . htmlspecialchars($row['nome']) . "</span></td>";
                echo "<td><div class='final'><div class='d-flex lixo'><a href='#' class='delete-item' data-id='" . $row['id'] . "'><i class='fa-solid fa-trash-can fa-2x mr-2'></i></a></div>";
                echo "<div class='d-flex justify-content-center align-items-center'><input type='checkbox' class='btn-check' autocomplete='off' name='comprado' value='1' data-id='" . $row['id'] . "' " . ($row['comprado'] ? "checked" : "") . "></div></div></td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='text-center'>Nenhum item encontrado.</p>";
        }
        ?>
        <div class="add text-center">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="post">
                <div class="form-group mr-2 row">
                    <input type="text" id="nome" name="nome" class="form-control form-control-lg col" required placeholder="Digite o nome do item...">
                    <button type="submit" id="botaoadicionar" name="submit" class="btn col-3">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('input[name="comprado"]').on('change', function() {
        var itemId = $(this).data('id');
        var comprado = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: 'update_item.php',
            method: 'POST',
            data: { item_id: itemId, comprado: comprado },
            success: function(response) {
                console.log('Item atualizado com sucesso');
            },
            error: function() {
                console.log('Erro ao atualizar item');
            }
        });
    });

    $('.delete-item').on('click', function(e) {
        e.preventDefault();
        var itemId = $(this).data('id');
        var row = $(this).closest('tr');
        $.ajax({
            url: 'delete_item.php',
            method: 'POST',
            data: { item_id: itemId },
            success: function(response) {
                console.log('Item excluído com sucesso');
                row.remove();
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
