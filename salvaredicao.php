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
        // Obtenha os dados antigos do banco de dados
        $email_sessao = $_SESSION['email'];
        $result = $conexao->query("SELECT nome, email, usuario, senha FROM registro WHERE email='$email_sessao'");
        $dados_antigos = $result->fetch_assoc();

        // Verifique se os campos foram preenchidos; se não, use os dados antigos
        $nome = !empty($_POST['nome']) ? $conexao->real_escape_string($_POST['nome']) : $dados_antigos['nome'];
        $email_form = !empty($_POST['email']) ? $conexao->real_escape_string($_POST['email']) : $dados_antigos['email'];
        $usuario = !empty($_POST['usuario']) ? $conexao->real_escape_string($_POST['usuario']) : $dados_antigos['usuario'];
        $senha = !empty($_POST['senha']) ? $conexao->real_escape_string($_POST['senha']) : $dados_antigos['senha'];

        // Atualize as informações no banco de dados
        $sql = "UPDATE registro SET nome='$nome', email='$email_form', usuario='$usuario', senha='$senha' WHERE email='$email_sessao'";
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
