<?php
session_start();

require_once('../includes/config.php');
require_once('../includes/funcoes.php');

verificarLogin();
verificarNivel('CLIENTE');

$usuario_id = $_SESSION['user_id'];
$usuario_nome = $_SESSION['user_nome'];

// Buscar idCliente
$stmt = $pdo->prepare("SELECT idCliente FROM cliente WHERE idUsuario = ?");
$stmt->execute([$usuario_id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Perfil de cliente não encontrado.");
}

$idCliente = $cliente['idCliente'];

// Buscar agendamentos
$stmt = $pdo->prepare("
    SELECT * FROM agendamento
    WHERE idCliente = ?
    ORDER BY criado_em DESC
");
$stmt->execute([$idCliente]);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar referências
$stmt = $pdo->prepare("
    SELECT * FROM referencias
    WHERE idCliente = ?
    ORDER BY criado_em DESC
");
$stmt->execute([$idCliente]);
$referencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/TESTE_TATTTOO/assets/css/style.css">
<h1>Olá, <?php echo htmlspecialchars($usuario_nome); ?></h1>

<hr>

<h2>📅 Meus Agendamentos</h2>

<?php if (empty($agendamentos)): ?>
    <p>Você ainda não possui agendamentos.</p>
<?php else: ?>
    <?php foreach ($agendamentos as $ag): ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong>Status:</strong> <?php echo $ag['status']; ?><br>
            <strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($ag['dataHora'])); ?><br>
            <strong>Tipo:</strong> <?php echo htmlspecialchars($ag['tipoTatuagem']); ?><br>
            <strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($ag['descricao'])); ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<hr>

<h2>❤️ Minhas Referências</h2>

<?php if (empty($referencias)): ?>
    <p>Você ainda não salvou referências.</p>
<?php else: ?>
    <?php foreach ($referencias as $ref): ?>
        <div style="margin-bottom:15px;">
            <img src="../uploads/referencias/<?php echo $ref['imagem']; ?>" width="150"><br>
            <?php echo htmlspecialchars($ref['descricao']); ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<hr>

<h2>➕ Novo Agendamento</h2>

<form method="POST" action="agendar.php">
    <label>Tipo da Tattoo:</label><br>
    <input type="text" name="tipoTatuagem" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao" required></textarea><br><br>

    <label>Data e Hora:</label><br>
    <input type="datetime-local" name="dataHora" required><br><br>

    <button type="submit">Agendar</button>
</form>

<br>
<a href="../logout.php">Sair</a>