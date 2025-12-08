<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mensagem_sucesso = "";
if (isset($_SESSION['sucesso_cadastro'])) {
    $mensagem_sucesso = $_SESSION['sucesso_cadastro'];
    unset($_SESSION['sucesso_cadastro']);
}

$mensagem_erro = "";
if (isset($_SESSION['erro_cadastro'])) {
    $mensagem_erro = $_SESSION['erro_cadastro'];
    unset($_SESSION['erro_cadastro']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Free Men's Barbearia</title>
    
    <link rel="stylesheet" href="css/style.css"> 
    </head>
<body>
    
    <?php if (!empty($mensagem_sucesso)): ?>
        <div class='alerta-container sucesso'>
            <strong>Sucesso!</strong> <?php echo htmlspecialchars($mensagem_sucesso); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($mensagem_erro)): ?>
        <div class='alerta-container erro'>
            <strong>Erro!</strong> <?php echo htmlspecialchars($mensagem_erro); ?>
        </div>
    <?php endif; ?>
    
    <aside class="sidebar">
        <div class="logo-section">
            <img src="../imagens/logo.png" alt="Logo Free Men's Barbearia" class="logo-img">
        </div>

        <ul class="nav-menu">
            <li><a href="#perfil">Meu perfil</a></li>
            <li><a href="#agendamentos">Agendamentos</a></li>
            <li><a href="#calendario">Calendário</a></li>
        </ul>
        
        <div class="menu-toggle-placeholder">
            <span class="menu-icon">&#x2261;</span> 
            <span class="page-count">3 / 4</span>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h1>Cadastro</h1>
        </div>

        <form action="../backend/processa_cadastro.php" method="POST" class="form-cadastro">
            
            <div class="form-group">
                <label for="nome_completo">Nome completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" required>
            </div>

            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <input type="text" id="sexo" name="sexo"> 
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00">
            </div>

            <div class="form-group observacao-group">
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" min="1" max="150">
            </div>

            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" id="celular" name="celular" maxlength="15" placeholder="(99) 99999-9999" required>
            </div>

            <div class="form-group observacao-group-full">
                <label for="observacao">Observação para barbeiro:</label>
                <textarea id="observacao" name="observacao"></textarea>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email">
            </div>
            
            <div class="submit-container">
                <button type="submit">Salvar</button>
            </div>

        </form>
    </main>

</body>
</html>