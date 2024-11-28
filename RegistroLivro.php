<?php
include 'config/database.php';
include 'classes/RegistroLivro.class.php';
session_start();

// Verifica se o usuário é administrador (nivelPermissao 2)
if (!isset($_SESSION['user_id']) || !isset($_SESSION['nivelPermissao']) || $_SESSION['nivelPermissao'] != 2) {
    header("Location: index.php");
    exit();
}

// Instancia a classe Livro
$livro = new Livro($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $anoPublicacao = $_POST['anoPublicacao'];
    $fotoCapa = $_POST['fotoCapa'];
    $idCategoria = $_POST['idCategoria'];
    $preco = $_POST['preco'];
    $idAutor = $_POST['idAutor'];

    // Adiciona o livro usando a classe
    $mensagem = $livro->adicionarLivro($titulo, $anoPublicacao, $fotoCapa, $idCategoria, $preco, $idAutor);
    echo $mensagem;
}

// Obtém as categorias e autores para o formulário
$categorias = $livro->obterCategorias();
$autores = $livro->obterAutores();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Adicionar Livro</title>
    <link rel="stylesheet" href="css/estilo3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Adicionar Novo Livro</h2>
    <form method="post">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="anoPublicacao">Ano de Publicação:</label>
            <input type="number" class="form-control" name="anoPublicacao">
        </div>
        <div class="form-group">
            <label for="fotoCapa">URL da Foto de Capa:</label>
            <input type="text" class="form-control" name="fotoCapa">
        </div>
        <div class="form-group">
            <label for="idCategoria">Categoria:</label>
            <select class="form-control" name="idCategoria" required>
                <option value="">Selecione uma Categoria</option>
                <?php while($categoria = $categorias->fetch_assoc()): ?>
                    <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['titulo']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idAutor">Autor:</label>
            <select class="form-control" name="idAutor" required>
                <option value="">Selecione um Autor</option>
                <?php while($autor = $autores->fetch_assoc()): ?>
                    <option value="<?php echo $autor['id']; ?>"><?php echo $autor['nome']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="text" class="form-control" name="preco" required>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Livro</button>
    </form>
    <br>
    <!-- Botões para redirecionar para a página de criação de categoria e autor -->
    <a href="Categoria.php" class="btn btn-secondary">Criar Nova Categoria</a>
    <a href="CriarAutor.php" class="btn btn-secondary">Criar Novo Autor</a>
</div>
</body>
</html>