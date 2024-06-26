<?php
include 'db.php';

// Usei a função real_escape_string para manipular os dados que vem do usuário, essa função ajuda na prevenção de SQL Injection.
$id = $conn->real_escape_string($_GET['id']);
$sql = "DELETE FROM tasks WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>