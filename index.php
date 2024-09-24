<?php
session_start();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listou!</title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
     <!-- Bootstrap CSS  dentro do head-->

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

     <!-- Font Awesome -->
 
 <script src="https://kit.fontawesome.com/4533a4cadf.js" crossorigin="anonymous"></script>
 
</head>
<body class="back  ">
    
 
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
                                
            <?php
                        if(isset($_SESSION['criado'])){

                          ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Hey!</strong> <?php  echo $_SESSION['criado'] ?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          <?php
                         
                          unset($_SESSION['criado']);
                                } ?>
              <div class="card rounded-3 text-black ">
                <div class="row align-items-center ">
                  <div class="col-lg-6 ">
                    <div class="card-body p-md-5 mx-md-4 ">
      
                      <div  class="image-fluid d-lg-none d-flex justify-content-center  mb-5"><img id="imgflu" src="img/listouu!.png"  width="200"></div>
      
                      <form class="form-group" action="teste.php" method="POST">
                        <p>Por favor, entre na sua conta:</p>
      
                        <div data-mdb-input-init class="form mb-4">
                          <input type="email" name="email" id="form2Example11" class="form-control form-control-lg"
                            placeholder=" E-mail" />
                          
                        </div>
      
                        <div data-mdb-input-init class="form   mb-4">
                          <input type="password" name="senha" id="form2Example22" class="form-control  form-control-lg" placeholder="Senha" />
                          
                          
                        </div>
      
                        <div class="text-center pt-1 mb-5 pb-1">
                          <input id="buttonlogin" name="submit" value="Entrar"  data-mdb-button-init data-mdb-ripple-init class="btn btn-lg  d-flex align-items-center justify-content-center" type="submit">
                          
                        </div>
                    
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Não tem uma conta?</p>
                          <a id="button" href="Registro.php"  data-mdb-button-init data-mdb-ripple-init class="btn ml-2 ">Inscreva-se</a>
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                  <div id="com" class="col-lg-6 d-flex align-items-center justify-content-center d-none d-lg-block">
                    <div id="none" class=" text-center  px-5 py-5 d-none d-lg-block ">
                      
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



    



    <!-- Bootstrap script - dentro do body-->

<!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   
</body>
</html>