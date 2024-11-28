<?php
include 'config/database.php';
session_start();

// Verifique se há uma sessão ativa e se o carrinho existe
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $cartItems = [];
} else {
    // Recupera os dados dos livros no carrinho
    $cartItems = [];
    $ids = implode(",", array_keys($_SESSION['cart']));
    if (!empty($ids)) {
        $sql = "SELECT id, titulo, preco, idCategoria AS genero FROM Livro WHERE id IN ($ids)";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $cartItems[$row['id']] = [
                'titulo' => $row['titulo'],
                'genero' => $row['genero'],
                'preco' => $row['preco'],
                'quantity' => $_SESSION['cart'][$row['id']]['quantity']
            ];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Carrinho</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo2.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Seu Carrinho</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Gênero</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalPrice = 0;
            foreach ($cartItems as $id => $item): 
                $totalItem = $item['preco'] * $item['quantity'];
                $totalPrice += $totalItem;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['titulo']) ?></td>
                <td><?= htmlspecialchars($item['genero']) ?></td>
                <td>$<?= number_format($item['preco'], 2) ?></td>
                <td>
                    <form method="POST" action="classes/Carrinho.class.php">
                        <input type="hidden" name="book_id" value="<?= $id ?>">
                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="form-control" style="width: 80px; display: inline;">
                        <button type="submit" name="update_quantity" class="btn btn-primary btn-sm">Atualizar</button>
                    </form>
                </td>
                <td>$<?= number_format($totalItem, 2) ?></td>
                <td>
                    <a href="classes/Carrinho.class.php?remove=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja remover este item?');">Remover</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Total: $<?= number_format($totalPrice, 2) ?></h3>
    <a href="compra.php" class="btn btn-primary">Finalizar Compra</a>
</div>
</body>
</html>