<?php
$servername = "localhost";
$username = "root";
$password = ""; // Normalmente, o XAMPP não possui senha para o root por padrão
$dbname = "login";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
