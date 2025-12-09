<?php
echo "<h1>ESTOU NA VERSÃO NOVA</h1>"; exit;
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
    $observacao    = trim($_POST['observacao'] ?? '');
    $idade         = !empty($_POST['idade']) ? (int)$_POST['idade'] : null;

    if (empty($nome_completo) || empty($celular)) {
        $_SESSION['erro_cadastro'] = "Nome e Celular são campos obrigatórios.";
        header("Location: ../frontend/cadastro.php");
        exit();
    }

    $sql = "INSERT INTO usuarios 
            (nome_completo, sexo, cpf, idade, celular, email, observacao) 
            VALUES (:nome_completo, :sexo, :cpf, :idade, :celular, :email, :observacao)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':nome_completo', $nome_completo);
    $stmt->bindValue(':sexo', $sexo);
    $stmt->bindValue(':cpf', $cpf);
    $stmt->bindValue(':idade', $idade, $idade === null ? PDO::PARAM_NULL : PDO::PARAM_INT); 
    $stmt->bindValue(':celular', $celular);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':observacao', $observacao);

    $stmt->execute();

    $_SESSION['sucesso_cadastro'] = "Cliente cadastrado com sucesso!";
    header("Location: ../frontend/painel.php"); 
    exit();

} catch(PDOException $e) {
    die("ERRO DE BANCO DE DADOS: " . $e->getMessage());
} catch(Exception $e) {
    die("ERRO GERAL: " . $e->getMessage());
}
?>