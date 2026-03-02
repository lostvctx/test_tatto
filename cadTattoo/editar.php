<?php
require '../conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: listar.php");
    exit;
}

// BUSCA LIVRO
$sql = "SELECT * FROM livros WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$livro) {
    header("Location: listar.php");
    exit;
}

// ATUALIZAÇÃO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo     = trim($_POST['titulo']);
    $autor      = trim($_POST['autor']);
    $disponivel = isset($_POST['disponivel']) ? 1 : 0;
    $imagem     = $livro['imagem'];

    // Upload nova imagem
    if (!empty($_FILES['imagem']['name'])) {

        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $nomeImagem = uniqid() . "." . $ext;
        $pasta = "../Imagens/";

        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $nomeImagem)) {

            if (!empty($livro['imagem']) && file_exists($pasta . $livro['imagem'])) {
                unlink($pasta . $livro['imagem']);
            }

            $imagem = $nomeImagem;
        }
    }

    $sql = "UPDATE livros SET 
                titulo = :titulo,
                autor = :autor,
                disponivel = :disponivel,
                imagem = :imagem
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':titulo' => $titulo,
        ':autor' => $autor,
        ':disponivel' => $disponivel,
        ':imagem' => $imagem,
        ':id' => $id
    ])) {

        echo "<script>
                alert('Livro atualizado com sucesso!');
                window.location='listar.php';
              </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Livro</title>
<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<div class="card-editar">

    <h1>Editar Livro</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="input-group">
            <label>Título</label>
            <input type="text" name="titulo" required value="<?= $livro['titulo'] ?>">
        </div>

        <div class="input-group">
            <label>Autor</label>
            <input type="text" name="autor" required value="<?= $livro['autor'] ?>">
        </div>

        <div class="input-group">
            <label>
                <input type="checkbox" name="disponivel" <?= $livro['disponivel'] ? 'checked' : '' ?>>
                Disponível
            </label>
        </div>

        <div class="input-group">
            <label>Imagem</label>
            <input type="file" name="imagem">
            <small>Deixe vazio para manter a imagem atual</small>
        </div>

        <?php if ($livro['imagem']) { ?>
            <div style="text-align:center;margin-bottom:15px;">
                <img src="../Imagens/<?= $livro['imagem'] ?>" style="max-width:140px;border-radius:8px;">
            </div>
        <?php } ?>

        <button type="submit" class="btn">Salvar Alterações</button>
        <a href="listar.php" class="btn-voltar">Voltar</a>

    </form>

</div>

</body>
</html>
