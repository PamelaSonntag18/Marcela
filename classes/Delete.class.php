<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Excluir o livro diretamente
    $sql = "DELETE FROM Livro WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../index.php?message=Livro+excluído+com+sucesso");
        exit;
    } else {
        echo "Erro ao excluir o livro: " . $conn->error;
    }
} else {
    header("Location: ../index.php?error=ID+inválido");
    exit;
}
?>
