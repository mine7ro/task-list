<?php
include 'db.php';

$id = $conn->real_escape_string($_GET['id']);

// Query para selecionar a tarefa pelo ID.
$sql = "SELECT description FROM tasks WHERE id=$id";
$result = $conn->query($sql);

// Verifica se há resultados encontrados.
if ($result->num_rows == 1) {
    $task = $result->fetch_assoc();
} else {
    echo "Tarefa não encontrada.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];

    // preg_match, para validar e limpar dados.
    if (preg_match("/^[a-zA-Z0-9 .,!?-]*$/", $description)) {
        $description = $conn->real_escape_string($description);
        $sql = "UPDATE tasks SET description='$description' WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            // Volta para a página principal após atualizar. 
            header("Location: index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Descrição inválida. Use apenas letras, números e .,!?-";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Tarefa</h1>

    <!-- Formulário para editar a descrição da tarefa -->
    <form method="post" action="">
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($task['description']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>