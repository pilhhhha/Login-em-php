<?php
include 'conexao.php';
include 'Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = new Usuario($conn);
    $mensagem = $usuario->cadastrar($nome, $email, $senha);
    echo $mensagem;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Welcome To Chat Space</title>
</head>
<body>
    <form class="login" action="cadastro.php" method="post">
        <h2>Login</h2>
        <div class="box-user">
            <input type="text" name="nome" required>
            <label>User Name</label>
        </div>
        <div class="box-user">
            <input type="text" name="email" required>
            <label>E-Mail</label>
        </div>
        <div class="box-user">
            <input type="password" name="senha" required>
            <label>Password</label>
        </div>
        <div>
            <a href="index.php" class="button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Back Home Page
            </a>
        </div>
        <button type="submit" class="button">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Create New Account
        </button>
    </form>
</body>
</html>