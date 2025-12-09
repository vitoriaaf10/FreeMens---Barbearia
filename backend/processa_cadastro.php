<?php
session_start();
include 'conexao.php'; 

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../frontend/cadastro.php");
    exit();
}

try {
    $nome_completo = trim($_POST['nome_completo'] ?? '');
    $sexo          = trim($_POST['sexo'] ?? '');
    $cpf           = trim($_POST['cpf'] ?? '');
    $celular       = trim($_POST['celular'] ?? '');
    $email         = trim($_POST['email'] ?? '');
    $senha         = trim($_POST['senha'] ?? '');
    $observacao    = trim($_POST['observacao'] ?? '');
    $idade         = !empty($_POST['idade']) ? (int)$_POST['idade'] : null;

    if (empty($nome_completo) || empty($celular) || empty($email) || empty($senha)) {
        $_SESSION['erro_cadastro'] = "Nome, Celular, E-mail e Senha são campos obrigatórios.";
        header("Location: ../frontend/cadastro.php");
        exit();
    }

    if (strlen($senha) < 6) {
        $_SESSION['erro_cadastro'] = "A senha deve ter no mínimo 6 caracteres.";
        header("Location: ../frontend/cadastro.php");
        exit();
    }

    $sql_verifica = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";
    $stmt_verifica = $conn->prepare($sql_verifica);
    $stmt_verifica->bindValue(':email', $email);
    $stmt_verifica->execute();

    if ($stmt_verifica->rowCount() > 0) {
        $_SESSION['erro_cadastro'] = "Este e-mail já está cadastrado.";
        header("Location: ../frontend/cadastro.php");
        exit();
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios 
            (nome_completo, sexo, cpf, idade, celular, email, senha, observacao) 
            VALUES (:nome_completo, :sexo, :cpf, :idade, :celular, :email, :senha, :observacao)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':nome_completo', $nome_completo);
    $stmt->bindValue(':sexo', $sexo);
    $stmt->bindValue(':cpf', $cpf);
    $stmt->bindValue(':idade', $idade, $idade === null ? PDO::PARAM_NULL : PDO::PARAM_INT); 
    $stmt->bindValue(':celular', $celular);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':senha', $senha_hash);
    $stmt->bindValue(':observacao', $observacao);

    $stmt->execute();

    $_SESSION['sucesso_login'] = "Cadastro realizado com sucesso! Faça login.";
    header("Location: ../frontend/login.php"); 
    exit();

} catch(PDOException $e) {
    $_SESSION['erro_cadastro'] = "Erro ao cadastrar. Tente novamente.";
    header("Location: ../frontend/cadastro.php");
    exit();
} catch(Exception $e) {
    $_SESSION['erro_cadastro'] = "Erro ao processar cadastro.";
    header("Location: ../frontend/cadastro.php");
    exit();
}
?>