<?php
include 'config/database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Porto Literário</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Available Books</h2>
    <div class="row">
        <?php
        // Query com JOINs para buscar os dados do livro, autor e categoria
        $sql = "
    SELECT 
        Livro.id, Livro.titulo, Livro.preco, Livro.fotoCapa, 
        Autor.nome AS autor, Categorias.descricao AS categoria
    FROM Livro
    INNER JOIN Autor ON Livro.idAutor = Autor.id
    INNER JOIN Categorias ON Livro.idCategoria = Categorias.id
";

        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()):
        ?>
            <div class="col-md-3">
                <div class="card">
                    <img src="<?= $row['fotoCapa'] ?>" class="card-img-top" alt="Book Cover">
                    <div class="card-body">
                        <!-- Título com Categoria -->
                        <h5 class="card-title">
                            <?= $row['titulo'] ?> 
                            <small class="text-muted">(<?= $row['categoria'] ?>)</small>
                        </h5>
                        <p class="card-text"><strong>Author:</strong> <?= $row['autor'] ?></p>
                        <p class="card-text"><strong>Price:</strong> $<?= $row['preco'] ?></p>
                        <a href="classes/Carrinho.class.php?id=<?= $row['id'] ?>" class="btn btn-primary">Adicionar ao Carrinho</a>
                        <!-- Botão de deletar -->
                        <a href="classes/Delete.class.php?id=<?= $row['id'] ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Você tem certeza que deseja deletar este livro?');">
                           Delete
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
