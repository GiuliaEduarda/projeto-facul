<?php

    


    



    session_start();
    if((!isset($_SESSION['email']) == true ) and (!isset($_SESSION['senha']) == true ) ){

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        
        header('Location: index.php');
        
    } 
         $logado = $_SESSION['email'];

       
    
   


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas listas</title>
    <link rel="shortcut icon" href="img/Listou!2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/minhaslistascss.css">
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
                            
                            <li class="nav-item"><a class="nav-link" href="">Minhas listas</a></li>
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
    <main id="main" class="d-flex justify-content-center align-items-center" >
       <div id="div" class="container-fluid d-flex justify-content-center">
        <div class=" nsei ">
        <div id="fora" class="d-flex">
                <a id="dent" class="w-75" href="">
                    <div id="dentro" class=" text-truncate" ><h1 id="Nomedalista ">Lista de cosdfsdfsfsfddmpras grande grande grande</h1></div>
                </a>
                <div  class="lixo"><a href=""><i class="fa-solid fa-pen-to-square fa-2x ml-2 mr-2"></i></a></div>
                <div  class="lixo"><a href=""><i class="fa-solid fa-trash-can fa-2x mr-2"></i></a></div>
               
            </div>
           
           
            <div>
                <form action="" class="to-do-form">
                    <input type="text" id="additionalInput" style="display: none;" name="description" id="description" class="form-control mr-3" placeholder="Write a new list name">
                    <button type="button" id="submitBtn" class="form-button">
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

    
</body>
</html>