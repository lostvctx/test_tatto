<?php
session_start();

require_once '../config.php';
require_once '../funcoes.php';

verificarLogin();
verificarNivel('TATUADOR');

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: area-tatuador.php");
    exit;
}

$idAgendamento = $_GET['id'];
$status = $_GET['status'];

// Permitir apenas esses status
$statusPermitidos = ['CONFIRMADO', 'CANCELADO', 'CONCLUIDO'];

if (!in_array($status, $statusPermitidos)) {
    header("Location: area-tatuador.php");
    exit;
}

// Atualizar
$stmt = $pdo->prepare("
    UPDATE agendamento
    SET status = ?
    WHERE idAgendamento = ?
");

$stmt->execute([$status, $idAgendamento]);

header("Location: area-tatuador.php");
exit;