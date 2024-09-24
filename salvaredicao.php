<?php
session_start();

// Verifique se o usuário está logado
if (isset($_SESSION['email'])) {
    // Conexão com o banco de dados
    include "config.php";

    // Verifique a conexão
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Verifique se os dados do formulário foram enviados
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtenha os dados do formulário com verificação de existência
        $nome = $_POST['nome'] ?? '';
        $email_form = $_POST['email'] ?? '';
        $usuario = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $email_sessao = $_SESSION['email'];

        // Atualize as informações no banco de dados
        $sql = "UPDATE `registro` SET `nome`='$nome', `email`='$email_form', `usuario`='$usuario' WHERE `email`='$email_sessao'";

        if ($conexao->query($sql) === TRUE) {
            
           
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email_form;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            

            header('Location: minhaconta.php');
            $_SESSION['atualizado'] = "Perfil atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o perfil: " . $conexao->error;
        }
    } else {
        echo "Nenhum dado foi enviado.";
    }

    $conexao->close();
} else {
    echo "Usuário não está logado.";
}
?>

