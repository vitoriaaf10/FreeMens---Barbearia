<?php
include 'conexao.php';
session_start();

$email = trim($_POST['login']);
$senha = trim($_POST['senha']);

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

            
            header("Location: ../frontend/painel.php"); 
            exit();

        } else {
            
            $_SESSION['erro_login'] = "Senha incorreta. Tente novamente.";
            header("Location: ../frontend/login.php");
            exit();
        }
    } else {
        
        $_SESSION['erro_login'] = "Usuário não encontrado.";
        header("Location: ../frontend/login.php");
        exit();
    }

} catch(PDOException $e) {
    
    $_SESSION['erro_login'] = "Erro de conexão: Não foi possível processar o login.";
  
    header("Location: ../frontend/login.php");
    exit();
}
?>