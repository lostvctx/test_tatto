<?php
// Importa o arquivo que faz a conexão com o banco de dados
require '../conexao.php';

// Cria um comando SQL para buscar todos os livros na tabela "livros"
$sql = "SELECT * FROM livros";

// Executa o comando SQL
$stmt = $pdo->query($sql);

// Pega todos os resultados e transforma em um array
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Livros</title>
<link rel="stylesheet" href="../CSS/style.css">

<style>
.btn-voltar {
    display: inline-block;
    padding: 10px 18px;
    background-color: #555;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 15px;
}
.btn-voltar:hover {
    background-color: #333;
}

img.capa {
    width: 60px;
    border-radius: 5px;
}
</style>

</head>
<body>

<div class="lista-container">
    <h1>Lista de Livros</h1>

    <!-- BOTÃO VOLTAR -->
    <a class="btn-voltar" href="../painel.php">Voltar para o Painel</a>

    <table class="tabela-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($livros as $l): ?>
            <tr>
                <td><?= $l['id'] ?></td>

                <td>
                    <?php if($l['imagem']): ?>
                        <img src="../imagens/<?= $l['imagem'] ?>" class="capa">
                    <?php else: ?>
                        Sem imagem
                    <?php endif; ?>
                </td>

                <td><?= $l['titulo'] ?></td>
                <td><?= $l['autor'] ?></td>

                <td>
                    <?= $l['disponivel'] ? 'Disponível' : 'Alugado' ?>
                </td>

                <td>
                    <a class="btn-editar" href="editar.php?id=<?= $l['id'] ?>">Editar</a>
                    <a class="btn-excluir" href="excluir.php?id=<?= $l['id'] ?>" onclick="return confirm('Deseja realmente excluir este livro?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
