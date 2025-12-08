<?php

session_start();

include 'conexao.php'; 


if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../frontend/cadastro.php");
    exit();
}


try {
    $nome_completo = trim($_POST['nome_completo'] ?? '');
    $sexo = trim($_POST['sexo'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $celular = trim($_POST['celular'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $observacao = trim($_POST['observacao'] ?? '');
    
    $idade = !empty($_POST['idade']) ? (int)$_POST['idade'] : null;

    if (empty($nome_completo) || empty($celular)) {
        $_SESSION['erro_cadastro'] = "Nome e Celular são campos obrigatórios.";
        header("Location: ../frontend/cadastro.php");
        exit();
    }

    $sql = "INSERT INTO usuarios 
            (nome_completo, sexo, cpf, idade, celular, email, observacao) 
            VALUES (:nome_completo, :sexo, :cpf, :idade, :celular, :email, :observacao)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nome_completo', $nome_completo);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':cpf', $cpf);
    
    $stmt->bindValue(':idade', $idade, PDO::PARAM_INT); 
    
    $stmt->bindParam(':celular', $celular);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':observacao', $observacao);

    if ($stmt->execute()) {
        
        $_SESSION['sucesso_cadastro'] = "Cliente cadastrado com sucesso!";
        
        header("Location: ../frontend/painel.php"); 
        exit();

    } else {
     
        $_SESSION['erro_cadastro'] = "Erro ao cadastrar: Verifique a validade dos dados (ex: CPF/Email duplicados).";
        header("Location: ../frontend/cadastro.php"); 
        exit();
    }

} catch(PDOException $e) {
    
    error_log("Erro PDO no cadastro: " . $e->getMessage()); 

    $_SESSION['erro_cadastro'] = "Erro interno: Não foi possível processar o cadastro.";
    
    header("Location: ../frontend/cadastro.php");
    exit();
}

?>