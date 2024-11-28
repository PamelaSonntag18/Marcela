<?php
include '../config/database.php';
include '../classes/Login.class.php';
session_start();

$login = new Login($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($login->autenticar($email, $senha)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Credenciais inválidas.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/estilo4.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
    <h2>Login</h2>
    <form method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <br>
    <!-- Botão de registro para redirecionar para register.php -->
    <a href="register.php" class="btn btn-secondary">Registrar</a>
</div>
</body>
</html>
