<?php
session_start();
include 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não autenticado']);
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$agendamento_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

try {
    $sql = "UPDATE agendamentos SET status = 'disponivel' WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $agendamento_id);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['sucesso' => true, 'mensagem' => 'Agendamento cancelado com sucesso']);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Agendamento não encontrado']);
    }

} catch(PDOException $e) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao cancelar agendamento']);
}
?>
