<?php

session_start();

$mensagem_erro = "";
if (isset($_SESSION['erro_login'])) {
    $mensagem_erro = $_SESSION['erro_login'];
    unset($_SESSION['erro_login']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Free Men's Barbearia</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="logo">
        <img src="../imagens/logo.png" alt="Logo Free Men's Barbearia" class="logo-img">
        </div>

        <?php if (!empty($mensagem_erro)): ?>
            <p style="color: red;"><?php echo $mensagem_erro; ?></p>
        <?php endif; ?>
        
        <form action="../backend/processa_login.php" method="POST">
            <input type="text" name="login" placeholder="Login:" required>
            <input type="password" name="senha" placeholder="Senha:" required>
            <button type="submit" class="btn-padrao">Entrar</button>
        </form>

        <p class="link-cadastro"> 
            <a href="cadastro.php">*Crie seu cadastro aqui!*</a>
        </p>
    </div>
</body>
</html>