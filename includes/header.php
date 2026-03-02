<?php
if (!isset($pdo)) {
    require_once 'includes/config.php';
    require_once 'includes/funcoes.php';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ink Studio - Tatuagens</title>
    <link rel="stylesheet" href="/teste_tatttoo/assets/css/style.css">
  
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo">
                    <span class="logo-icon">📅</span>
                    <span class="logo-text">Ink Studio</span>
                </a>

                <nav class="nav">
                    <a href="index.php" class="nav-link">Início</a>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <a href="area-cliente.php" class="nav-link">
                            👤 <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                        </a>
                        <a href="logout.php" class="nav-link">Sair</a>
                    <?php else: ?>
                        <a href="login.php" class="nav-link">Login</a>
                        <a href="cadastro.php" class="btn-primary">Cadastre-se</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>