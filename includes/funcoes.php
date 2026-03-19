<?php

function limparDados($dados) {
    return htmlspecialchars(trim($dados));
}

function verificarLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }
}

function verificarNivel($nivel) {
    if ($_SESSION['user_nivel'] !== $nivel) {
        header("Location: ../login.php");
        exit;
    }
}

function logout() {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit;
}