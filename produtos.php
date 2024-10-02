<?php
// Inicia o buffer de saída para evitar problemas de redirecionamento
ob_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas listas</title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/produtos.css">

    <!-- Bootstrap CSS  dentro do head-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- Font Awesome -->

<script src="https://kit.fontawesome.com/4533a4cadf.js" crossorigin="anonymous"></script>
    <style>
        /* Estilos para as linhas da tabela */
        tbody tr:nth-child(odd) {
            background-color: #644989; /* Cor roxa */
            color: white; /* Texto em branco para contraste */
        }

        tbody tr:nth-child(even) {
            background-color: white; /* Cor branca */
            color: black; /* Texto em preto */
        }

      

        .edit-container {
            display: none; /* Esconde o container de edição inicialmente */
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
                        <ul class="navbar-nav nav-img d-none d-lg-block  "> 
                            <li class="nav-item d-none d-lg-block "><img src="img/Listou___1_-removebg-preview.png" width="60" alt=""></li>
                        </ul>
                        <ul class="navbar-nav  ">
                            <li class="nav-item "><a class="btn btn-outline-light" href="minhaconta.php"><i class="fa-regular fa-circle-user fa-lg mr-2"></i>Minha conta</a></li>
                            <li class="nav-item"><a class="btn btn-outline-light" href="sair.php" >Sair</a></li>
            
                        </ul>
            
            
        
                    </div>
            </div>
        </nav>

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-100 " role="document">
              <div class="modal-content pt-2 justify-content-between ">
                <div class="modal-header d-flex  ">
        
                  <div id="conta2" class=" mr-1 row btn btn-light ">
                    <ul class="navbar-nav  ">
                        <li class="nav-item "><a class="btn btn-outline-light" href="minhaconta.php"><i class="fa-regular fa-circle-user fa-lg mr-2"></i>Minha conta</a></li>                 
        
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
    
        <!-- Nome da Lista -->
    
            <div class="lista" style="margin-top: 2rem;"    >
                <h1 style="color: white;">primeira lista</h1>
            </div>
    
        <div class="container tra mt-5">
        <?php
        require_once 'config.php';
    
        // Verifica se o formulário de atualização de checkbox foi enviado
        if (isset($_POST['update_comprado'])) {
            $id = $_POST['item_id'];
            $comprado = isset($_POST['comprado']) ? 1 : 0; // Se marcado, valor 1, senão 0
    
            // Atualiza o status de "comprado" no banco de dados
            $update_query = "UPDATE itens SET comprado = '$comprado' WHERE id = $id";
            mysqli_query($conn, $update_query);
        }
    
        // Verifica se o formulário de edição foi enviado
        if (isset($_POST['update_nome'])) {
            $id = $_POST['item_id'];
            $novo_nome = $_POST['novo_nome'];
    
            // Atualiza o nome do item no banco de dados
            $update_query = "UPDATE itens SET nome = '$novo_nome' WHERE id = $id";
            mysqli_query($conn, $update_query);
        }
    
        // Consulta para selecionar todos os itens da tabela 'itens'
        $query = "SELECT * FROM itens";
        $result = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered'>
                   
                    <tbody>";
    
            // Loop através dos resultados e exibir os itens em uma tabela
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class=''>
                        
                       <td id='che' class=' '>

                            <span class='item-nome'>" . $row['nome'] . "</span>
                           
                       
                            <td>
                          <div class='final '>
                              <div class='d-flex lixo'>
                                  
                                  <a href='excluir.php?id=" . $row['id'] . "' class='ex' '><i class='fa-solid fa-trash-can fa-2x mr-2'></i></a>
                              </div>
                              <form action='' method='post' class='d-flex justify-content-center align-items-center'>
                                <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                <input type='checkbox' class='btn-check' autocomplete='off' name='comprado' value='1' onchange='this.form.submit()' " . ($row['comprado'] ? "checked" : "") . ">
                                <input  type='hidden' name='update_comprado' value='1'>
                              </form>
                          </div>

                        </td>
                        
                      </tr>";
            }
   
            echo "</tbody></table>";
        } else {
            echo "<p class='text-center'>Nenhum item encontrado.</p>";
        }
    
        // Verifica se o formulário de adição foi enviado
        if (isset($_POST['submit'])) {
            $nome = $_POST['nome'];
            $comprado = 0; // Define como não comprado inicialmente
    
            // Insere o novo item no banco de dados
            $query = "INSERT INTO itens (nome, comprado) VALUES ('$nome', '$comprado')";
            $result = mysqli_query($conn, $query);
    
            if ($result) {
                // Atualiza os IDs dos itens após a inserção
                $update_query = "SET @new_id = 0;
                                 UPDATE itens SET id = (@new_id := @new_id + 1) ORDER BY id;";
    
                mysqli_multi_query($conn, $update_query);
    
                // Redireciona para a mesma página após adicionar o item
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Erro ao adicionar item: " . mysqli_error($conn);
            }
        }
    
        // Fecha a conexão
        mysqli_close($conn);
        ?>
        
    <div class="add text-center ">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class=" justify-content-center">
            <div class="form-group mr-2 row">
                
                <input type="text" id="nome" name="nome" class="form-control form-control-lg  col" required placeholder="Digite o nome do item...">
               <button type="submit" id="botaoadicionar" name="submit" class="btn col-3">Adicionar</button>
            </div>
            
        </form>
    </div>
</main>

    <script>
        // Função para alternar a exibição do formulário de edição
        function toggleEdit(itemId) {
            const editContainer = document.getElementById('edit-container-' + itemId);
            if (editContainer.style.display === "none" || editContainer.style.display === "") {
                editContainer.style.display = "block"; // Exibe o formulário de edição
            } else {
                editContainer.style.display = "none"; // Esconde o formulário de edição
            }
        }
    </script>

    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
