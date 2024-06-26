<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tasks_db";

// Uso essa função para criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checando a conexão.
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>