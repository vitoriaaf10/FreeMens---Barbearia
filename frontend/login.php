<?php

session_start();

$mensagem_erro = "";
if (isset($_SESSION['erro_login'])) {
    $mensagem_erro = $_SESSION['erro_login'];
    unset($_SESSION['erro_login']);
}

$mensagem_sucesso = "";
if (isset($_SESSION['sucesso_login'])) {
    $mensagem_sucesso = $_SESSION['sucesso_login'];
    unset($_SESSION['sucesso_login']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Free Men's Barbearia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="logo">
            <img src="../imagens/logo.png" alt="Logo Free Men's Barbearia" class="logo-img">
        </div>

        <?php if (!empty($mensagem_erro)): ?>
            <div class="alert alert-erro"><?php echo htmlspecialchars($mensagem_erro); ?></div>
        <?php endif; ?>

        <?php if (!empty($mensagem_sucesso)): ?>
            <div class="alert alert-sucesso"><?php echo htmlspecialchars($mensagem_sucesso); ?></div>
        <?php endif; ?>
        
        <form action="../backend/processa_login.php" method="POST">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="login" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn-padrao">Entrar</button>
        </form>

        <p class="link-cadastro"> 
            <a href="cadastro.php">Criar nova conta</a>
        </p>
    </div>
</body>
</html>