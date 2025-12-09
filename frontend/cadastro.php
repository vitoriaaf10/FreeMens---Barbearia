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
        <div style="background: #d4edda; color: #155724; padding: 10px; margin: 10px;">
            <strong>Sucesso!</strong> <?php echo htmlspecialchars($mensagem_sucesso); ?>
        </div>
    <?php endif; ?>

    
    <aside class="sidebar">
        <div class="logo-section" style="text-align: center; padding: 20px;">
            <img src="imagens/logo.png" alt="Logo" style="width: 120px; height: auto; display: block; margin: 0 auto;">
            <h2 style="font-size: 14px; margin-top: 10px;">FREE MEN'S</h2>
            <h3 style="font-size: 12px;">BARBEARIA</h3>
        </div>

        <ul class="nav-menu">
            <li><a href="#perfil">Meu perfil</a></li>
            <li><a href="#agendamentos">Agendamentos</a></li>
            <li><a href="#calendario">Calendário</a></li>
        </ul>
    </aside>

    <main class="main-content"> 
        </main>
</body>
</html>