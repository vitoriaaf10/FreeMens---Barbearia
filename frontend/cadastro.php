<?php
session_start();

$mensagem_erro = "";
if (isset($_SESSION['erro_cadastro'])) {
    $mensagem_erro = $_SESSION['erro_cadastro'];
    unset($_SESSION['erro_cadastro']);
}

$mensagem_sucesso = "";
if (isset($_SESSION['sucesso_cadastro'])) {
    $mensagem_sucesso = $_SESSION['sucesso_cadastro'];
    unset($_SESSION['sucesso_cadastro']);
}
?>

<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Men's Barbearia - Cadastro</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>

    <aside class="sidebar">
        <div class="logo-area">
            <div class="logo-symbol">FM</div>
            <div class="logo-text">FREE MEN'S</div>
            <div class="logo-sub"><i class="fas fa-scissors"></i> BARBEARIA</div>
        </div>

        <nav>
            <ul class="menu">
                <li><a href="cadastro.php" class="active"><i class="fas fa-user-plus"></i> Cadastro</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <i class="fas fa-bars"></i>
        </div>
    </aside> 

    <main class="main-content">
        <div class="header-title">
            <i class="fas fa-user-plus"></i> Cadastro de Cliente
        </div>

        <?php if (!empty($mensagem_erro)): ?>
            <div class="alert alert-erro"><?php echo htmlspecialchars($mensagem_erro); ?></div>
        <?php endif; ?>

        <?php if (!empty($mensagem_sucesso)): ?>
            <div class="alert alert-sucesso"><?php echo htmlspecialchars($mensagem_sucesso); ?></div>
        <?php endif; ?>

        <form class="form-container" action="../backend/processa_cadastro.php" method="POST">
            <div class="form-group">
                <label>Nome completo:</label>
                <input type="text" name="nome_completo" required>
            </div>

            <div class="form-group">
                <label>Sexo:</label>
                <select name="sexo">
                    <option value="">Selecione</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label>CPF:</label>
                <input type="text" name="cpf" maxlength="14">
            </div>

            <div class="form-group">
                <label>Idade:</label>
                <input type="number" name="idade" min="0" max="150">
            </div>

            <div class="form-group">
                <label>Celular:</label>
                <input type="text" name="celular" required>
            </div>

            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="senha" required minlength="6">
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label>Observação para barbeiro:</label>
                <textarea name="observacao" rows="4"></textarea>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn-save">Cadastrar</button>
                <a href="login.php" class="btn-secondary">Já tenho conta</a>
            </div>
        </form>
    </main>

</body>
</html>