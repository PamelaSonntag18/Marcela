<?php
include 'config/database.php';
include 'classes/CriarAutor.class.php';
session_start();

// Verifica se o usuário é administrador (nivelPermissao 2)
if (!isset($_SESSION['user_id']) || !isset($_SESSION['nivelPermissao']) || $_SESSION['nivelPermissao'] != 2) {
    header("Location: index.php");
    exit();
}

// Instancia a classe Autor
$autor = new Autor($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];

    // Adiciona o autor usando a classe
    $mensagem = $autor->adicionarAutor($nome, $sobrenome);
    echo $mensagem;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Criar Novo Autor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Adicionar Novo Autor</h2>
    <form method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="form-group">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" class="form-control" name="sobrenome" required>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Autor</button>
    </form>
</div>
</body>
</html>