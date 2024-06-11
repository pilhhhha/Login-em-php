<?php
include 'conexao.php';
include 'Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['mail'];
    $senha = $_POST['password'];

    $usuario = new Usuario($conn);
    $mensagem = $usuario->login($email, $senha);
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
    <form class="login" action="index.php" method="post">
        <h2>Login</h2>
        <div class="box-user">
            <input type="text" name="" required>
            <label>User</label>
        </div>
        <div class="box-user">
            <input type="password" name="" required>
            <label>Password</label>
        </div>
        <div class="forget">
            <a href="cadastro.php" class="button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                New Account ?
            </a>
            <a href="#" class="button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Forgot Password
            </a>
        </div>
        <a href="#" class="button">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Enter
        </a>
    </form>
</body>
</html>