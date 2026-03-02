<?php
session_start();

require_once '../config.php';
require_once '../funcoes.php';

verificarLogin();
verificarNivel('CLIENTE');

$usuario_id = $_SESSION['user_id'];

// Buscar idCliente
$stmt = $pdo->prepare("SELECT idCliente FROM cliente WHERE idUsuario = ?");
$stmt->execute([$usuario_id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Cliente não encontrado.");
}

$idCliente = $cliente['idCliente'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipo = limparDados($_POST['tipoTatuagem']);
    $descricao = limparDados($_POST['descricao']);
    $dataHora = $_POST['dataHora'];

    // Aqui você pode definir um tatuador fixo por enquanto (ex: ID 1)
    $idTatuador = 1;

    $stmt = $pdo->prepare("
        INSERT INTO agendamento 
        (idCliente, idTatuador, dataHora, tipoTatuagem, descricao, status)
        VALUES (?, ?, ?, ?, ?, 'PENDENTE')
    ");

    $stmt->execute([
        $idCliente,
        $idTatuador,
        $dataHora,
        $tipo,
        $descricao
    ]);

    header("Location: area-cliente.php");
    exit;
}