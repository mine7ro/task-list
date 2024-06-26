<?php
include 'db.php';

// Função para excluir uma tarefa pelo ID
function deleteTask($id) {
    global $conn;
    $sql = "DELETE FROM tasks WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Verifica se o método GET 'action' é 'delete' e o parâmetro 'id' está presente
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Chama a função para excluir a tarefa
    if (deleteTask($id)) {
        // Redireciona de volta para a página principal após a exclusão
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao excluir a tarefa.";
    }
}

// Seleciona todas as tarefas da tabela 'tasks'.
$sql = "SELECT id, description FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0; 
        }
        
        
        .container {
            background-color: #ffffff; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
    </style>
     <script>
        // Função para exibir um alerta de confirmação ao excluir uma tarefa.
        function confirmDelete(id) {
            if (confirm("Tem certeza que deseja excluir esta tarefa?")) {
                // Redireciona para a URL de exclusão se o usuário confirmar que quer excluir. 
                window.location.href = `index.php?action=delete&id=${id}`;
            }
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h1>Lista de Tarefas</h1>   
    <!---Tabela para exibir as tarefas --->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>

        <!---Para evitar XSS, eu usei a função htmlspecialchars.--->
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <!---Aqui exibe a descrição da tarefa.--->
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                     <!-- Botões para editar e excluir a tarefa -->
                    <a href="editar_tarefas.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                    <!-- Botão de exclusão com chamada à função JavaScript confirmDelete -->
                    <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger">Excluir</button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <!---Botão para adcionar nova tarefa--->
    <a href="add_tarefas.php" class="btn btn-success">Adicionar Nova Tarefa</a>
</div>
</body>
</html>

<?php
$conn->close();
?>