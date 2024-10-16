<?php
session_start();

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){
    
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o email existe
    $sql_email = "SELECT * FROM registro WHERE email = '$email'";
    $result_email = $conexao->query($sql_email);

    if(mysqli_num_rows($result_email) < 1){
        $_SESSION['login_erro'] = 'Você não está cadastrado!';
        header('Location: index.php');
        exit();
    } else {
        // Verificar se a combinação de email e senha está correta
        $sql = "SELECT * FROM registro WHERE email = '$email' and senha = '$senha'";
        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            
            $_SESSION['login_erro'] = 'Email ou senha incorretos';
            header('Location: index.php');
            exit();
        } else {
            $row = $result->fetch_assoc();
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['user_id'] = $row['id'];
            header('Location: minhaslistas.php');
            exit();
        }
    }
} else {
    $_SESSION['login_erro'] = 'Você não está cadastrado!';
    header('Location: index.php');
    exit();
}
?>

