<?php
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: index.php');
    exit();
}

$logado = $_SESSION['email'];
include 'config.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas listas</title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/minhaslistascss.css">
    <!-- Bootstrap CSS dentro do head-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4533a4cadf.js" crossorigin="anonymous"></script>
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
                    <li class="nav-item"><a class="nav-link" href="">Minhas listas</a></li>
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
<main id="main" class="d-flex justify-content-center align-items-center">
    <div id="div" class="container-fluid d-flex justify-content-center">
        <div class="nsei">
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['message']) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <?php
            $sql = "SELECT id_listas, nome_lista FROM listas WHERE email = '$logado'";
            $result = $conexao->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div id='fora' class='d-flex w-100'>";
                    echo "<a id='dent' class='w-75 pl-2' href='produtos.php?id=" . $row["id_listas"] . "&nome_lista=" . urlencode($row["nome_lista"]) . "'>";
                    echo "<div id='dentro' class='text-truncate'><h1 id='Nomedalista'>" . htmlspecialchars($row["nome_lista"]) . "</h1></div>";
                    echo "</a>";
                    echo "<div id='lixo'><a id='edit' href='editar.php?id=" . $row["id_listas"] . "'><i class='fa-solid fa-pen-to-square fa-2x ml-2 mr-2'></i></a></div>";
                    echo "<div id='lixo'><a href='deletar.php?id=" . $row["id_listas"] . "' onclick='return confirm(\"Tem certeza que deseja deletar esta lista?\");'><i class='fa-solid fa-trash-can fa-2x mr-2'></i></a></div>";
                    echo "</div>";
                }
            } else {
                echo "Você ainda não criou nenhuma lista!";
            }
            $conexao->close();
            ?>
            <form action="criar.php" method="post" class="to-do-form">
                <input type="text" name="nome_lista" id="additionalInput" class="form-control mr-3" placeholder="Escreva o nome da nova lista">
                <button class="form-button" id="submitBtn">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </form>
        </div>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>
<script defer>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.fa-pen-to-square').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let container = this.closest('#fora');
            if (container) {
                let h1 = container.querySelector('#Nomedalista');
                if (h1) {
                    let currentText = h1.textContent;
                    let input = document.createElement('input');
                    input.type = 'text';
                    input.value = currentText;
                    h1.replaceWith(input);
                    input.focus();
                    input.style.backgroundColor = 'transparent';
                    input.style.color = 'white';

                    input.addEventListener('blur', function() {
                        let newText = input.value;
                        let h1 = document.createElement('h1');
                        h1.id = 'Nomedalista';
                        h1.textContent = newText;
                        input.replaceWith(h1);

                        // Enviar a atualização para o servidor
                        let id_lista = container.querySelector('a').href.split('id=')[1];
                        fetch('editar.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `id_listas=${id_lista}&nome_lista=${newText}`
                        }).then(response => response.text()).then(data => {
                            console.log(data);
                        }).catch(error => {
                            console.error('Erro:', error);
                        });
                    });
                } else {
                    console.error('Elemento #Nomedalista não encontrado');
                }
            } else {
                console.error('Elemento #fora não encontrado');
            }
        });
    });
});
</script>

</body>
</html>
