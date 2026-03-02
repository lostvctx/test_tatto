<?php
session_start();
require_once 'config.php';
require_once 'funcoes.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = limparDados($_POST['email']);
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->execute([$email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {

        // Criar sessão
        $_SESSION['user_id'] = $usuario['idUsuario'];
        $_SESSION['user_nome'] = $usuario['nome'];
        $_SESSION['user_nivel'] = $usuario['nivel'];

        // 🔥 AQUI É O REDIRECIONAMENTO POR NÍVEL
        if ($usuario['nivel'] === 'TATUADOR') {
            header("Location: tatuador/area-tatuador.php");
        } elseif ($usuario['nivel'] === 'ADMIN') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: cliente/area-cliente.php");
        }

        exit;

    } else {
        $erro = "Email ou senha inválidos!";
    }
}
?>