<?php
require_once 'includes/config.php';
require_once 'includes/funcoes.php';

verificarLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario_id = $_SESSION['usuario_id'];

    $tipo = limparDados($_POST['tipo']);
    $data = limparDados($_POST['data_agendamento']);
    $hora = limparDados($_POST['hora_agendamento']);

    $tipo_tatuagem = $_POST['tipo_tatuagem'] ?? null;
    $primeira_tatuagem = $_POST['primeira_tatuagem'] ?? null;
    $parte_corpo = $_POST['parte_corpo'] ?? null;
    $tamanho = $_POST['tamanho'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    $stmt = $pdo->prepare("
        INSERT INTO agendamentos 
        (usuario_id, tipo, tipo_tatuagem, primeira_tatuagem, parte_corpo, tamanho, descricao, data_agendamento, hora_agendamento) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt->execute([
        $usuario_id,
        $tipo,
        $tipo_tatuagem,
        $primeira_tatuagem,
        $parte_corpo,
        $tamanho,
        $descricao,
        $data,
        $hora
    ])) {
        $_SESSION['mensagem'] = 'Agendamento solicitado com sucesso!';
        $_SESSION['tipo_mensagem'] = 'sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao processar agendamento.';
        $_SESSION['tipo_mensagem'] = 'erro';
    }
}

header('Location: area-cliente.php');
exit;