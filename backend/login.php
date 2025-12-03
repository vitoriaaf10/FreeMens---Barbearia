<?php
include 'conexao.php';
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

try {
    $sql = "SELECT id, nome_completo, email, senha FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if (password_verify($senha, $usuario['senha'])) {

            
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome']       = $usuario['nome_completo'];

            echo "ok"; 
        } else {
            echo "senha_incorreta";
        }
    } else {
        echo "email_nao_encontrado";
    }

} catch(PDOException $e) {
    echo "erro: " . $e->getMessage();
}
