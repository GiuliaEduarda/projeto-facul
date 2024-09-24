<?php

session_start();

if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
   

    // Verifica se o usuário ou e-mail já existem
    $sql = "SELECT * FROM registro WHERE usuario = ? OR email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o usuário ou e-mail já existem, exibe uma mensagem
        
        $_SESSION['login_erro'] = 'Email ou usuário já cadastrado';
        header('Location: registro.php');
        exit();
    } else {
        // Insere o novo usuário usando parâmetros preparados
        $sql = "INSERT INTO registro (nome, email, usuario, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $usuario, $senha);
        $stmt->execute();

        // Redireciona para a página inicial
        $_SESSION['criado'] = 'Perfil criado com sucesso!';
        header('Location: index.php');
        
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listou!</title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/registro.css">
     <!-- Bootstrap CSS  dentro do head-->

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

     <!-- Font Awesome -->
 
 <script src="https://kit.fontawesome.com/4533a4cadf.js" crossorigin="anonymous"></script>
 
</head>
<body class="back">
    
    <section class=" back  d-flex justify-content-center align-items-center "  >
      
        <div class="container py-5 h-100  ">
          <div class="row d-flex justify-content-center align-items-center h-100">
            
            <div class="col-xl-10 ">
              
            <?php
                        if(isset($_SESSION['login_erro'])){

                          ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>Hey!</strong> <?php  echo $_SESSION['login_erro'] ?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          <?php
                         
                          unset($_SESSION['login_erro']);
                         } ?>
              <div class="card rounded-3 text-black ">
                <div class="row align-items-center ">
                  <div class="col-lg-6 ">
                    <div class="card-body p-md-5 mx-md-4 ">
      
                      <div  class="image-fluid d-lg-none d-flex justify-content-center  mb-5"><img id="imgflu" src="img/listouu!.png"  width="200"></div>
      
                      <form action="registro.php" method="POST" class="form-group">
                        <p>Por favor, complete os campos:</p>
      
                        <div data-mdb-input-init class="form mb-4">
                          <input type="text" name="nome" required id="form2Example11" class="form-control form-control-lg"
                            placeholder="Nome" />
                          
                        </div>
      
                        <div data-mdb-input-init class="form   mb-4">
                          <input type="email" name="email" required id="form2Example22" class="form-control  form-control-lg" placeholder="E-mail" />
                          
                          
                        </div>
                        <div data-mdb-input-init class="form   mb-4">
                            <input type="text" name="usuario" required id="form2Example22" class="form-control  form-control-lg" placeholder="Nome de usuário" />
                            
                            
                          </div>
                          <div data-mdb-input-init class="form   mb-4">
                            <input type="password" name="senha" required id="form2Example22" class="form-control  form-control-lg" placeholder="Senha" />
                            
                            
                          </div>


                          
                         
                        
      
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button id="buttonlogin" data-mdb-button-init data-mdb-ripple-init class="btn btn-lg  btn-outline-dark  d-flex align-items-center justify-content-center" name="submit" type="submit">Registrar-se</button >
                          
                        </div>
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Já tem uma conta?</p>
                          <a id="button" href="index.php" type="button" data-mdb-button-init data-mdb-ripple-init class="btn ml-2 ">Entrar</a>
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                  <div id="com" class="col-lg-6 d-flex align-items-center justify-content-center d-none d-lg-block">
                    <div id="none" class=" text-center   d-none d-lg-block ">
                      
                      <img class="image-fluid " src="img/listouu!.png" width="350" alt="">
                      
                      <p id="sualista" class="mb-5 ml-2">Sua lista de compras</p>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            let email = document.getElementById('email').value;
            let senha = document.getElementById('senha').value;
            let errors = [];

            if (email === '') {
                errors.push('Email não pode ser vazio');
            }
            if (senha === '') {
                errors.push('Senha não pode ser vazia');
            }

            if (errors.length > 0) {
                event.preventDefault();
                let errorDiv = document.querySelector('.error');
                errorDiv.innerHTML = '';
                errors.forEach(function(error) {
                    let p = document.createElement('p');
                    p.textContent = error;
                    errorDiv.appendChild(p);
                });
            }
        });
    </script>

</body>
</html>
