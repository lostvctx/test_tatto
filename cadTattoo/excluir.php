<?php
require '../conexao.php';

// Verifica se veio o ID pela URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$id = intval($_GET['id']);

try {

    // Busca a imagem do livro antes de excluir
    $sql = "SELECT imagem FROM livros WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se existir imagem, apaga da pasta Imagens
    if ($livro && !empty($livro['imagem'])) {
        $caminhoImagem = '../Imagens/' . $livro['imagem'];
        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }

    // Exclui o livro do banco
    $sql = "DELETE FROM livros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    // Volta para a lista
    header("Location: listar.php");
    exit;

} catch (PDOException $e) {
    echo "Erro ao excluir: " . $e->getMessage();
}
?>
