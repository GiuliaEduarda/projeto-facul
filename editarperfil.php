


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha conta</title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/editarperfil.css">
     <!-- Bootstrap CSS  dentro do head-->

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

     <!-- Font Awesome -->
 
 <script src="https://kit.fontawesome.com/4533a4cadf.js" crossorigin="anonymous"></script>
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
    <main class="d-flex ">
        <section class="container d-flex justify-content-center caixa">
            <div class="row caixausuario   align-items-center ">
                <div class="col-lg-6 maisuma m-auto text-center  d-flex flex-column justify-content-center align-items-center">
                   
                <div class="usuario  p-5"><i class="fa-solid fa-user"></i></div>
                    <form method="POST"  action="salvaredicao.php" class="input-group flex-column  align-items-center justify-content-center">
                        <div data-mdb-input-init class="form mb-4">
                            <input type="text" name="nome"  class="form-control form-control-lg"  placeholder="Editar nome" autocomplete="$_SESSION" />
                        </div>
                        <div data-mdb-input-init class="form mb-4">
                            <input type="email" name="email"  class="form-control form-control-lg"  placeholder="Editar email" autocomplete="$_SESSION"  />
                        </div>
                        <div data-mdb-input-init class="form mb-4">
                            <input type="text" name="usuario"  class="form-control form-control-lg"  placeholder="editar usuario" autocomplete="$_SESSION" />
                        </div>
                        <div data-mdb-input-init class="form mb-4  ">
                            <input type="password" name="senha" class="form-control form-control-lg"  placeholder="editar senha" autocomplete="$_SESSION"  />
                        </div>

                        
                       
   
                     
                        
                        <div class="text-center mb-4">
                        <button class="btn btn-danger btn-lg" type="submit" value="atualizar">Salvar</button>
                    </div>
                        
                       
                    
                    </form>
                    
                </div>
            </div>
        </section>
    </main>
    
    

    <!-- Bootstrap script - dentro do body-->

<!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   
    
</body>
</html>