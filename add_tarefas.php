<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];

    // preg_match, para validar e limpar dados.
    if (preg_match("/^[a-zA-Z0-9 .,!?-]*$/", $description)) {
        $description = $conn->real_escape_string($description);

        // SQL para adcionar a nova tarefa no banco de dados. 
        $sql = "INSERT INTO tasks (description) VALUES ('$description')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Exibe essa mensagem de erro se houver algum problema com a query SQL.
        echo "Descrição inválida. Use apenas letras, números e .,!?-";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Formulário para adicionar nova tarefa -->
     
    <h1>Adicionar Nova Tarefa</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>