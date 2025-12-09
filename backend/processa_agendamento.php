<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../frontend/login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$data = trim($_POST['data']);
$horario = trim($_POST['horario']);

try {
    $sql_verifica = "SELECT id FROM agendamentos WHERE data_agendamento = :data AND horario = :horario AND status = 'reservado'";
    $stmt_verifica = $conn->prepare($sql_verifica);
    $stmt_verifica->bindParam(':data', $data);
    $stmt_verifica->bindParam(':horario', $horario);
    $stmt_verifica->execute();

    if ($stmt_verifica->rowCount() > 0) {
        $_SESSION['erro_agendamento'] = "Este horário já está ocupado. Por favor, escolha outro.";
        header("Location: ../frontend/agendamentos.php");
        exit();
    }

    $sql = "INSERT INTO agendamentos (usuario_id, barbeiro_id, data_agendamento, horario, status) VALUES (:usuario_id, NULL, :data, :horario, 'reservado')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':horario', $horario);
    $stmt->execute();

    $_SESSION['sucesso_agendamento'] = "Agendamento realizado com sucesso!";
    header("Location: ../frontend/agendamentos.php");
    exit();

} catch(PDOException $e) {
    die("Erro ao processar agendamento: " . $e->getMessage());
}
?>
