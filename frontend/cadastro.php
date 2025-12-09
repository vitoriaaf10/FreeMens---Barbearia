<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Men's Barbearia - Cadastro</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="style.css"> 
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
                <li><a href="#"><i class="fas fa-user-circle"></i> Meu perfil</a></li>
                <li><a href="#"><i class="fas fa-book-open"></i> Agendamentos</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i> Calendário</a></li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <i class="fas fa-bars"></i>
        </div>
    </aside> 

    <main class="main-content">
        <div class="header-title">
            <i class="fas fa-user-plus"></i> Cadastro
        </div>

        <form class="form-container">
            <div class="form-group">
                <label>Nome completo:</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>Sexo:</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>CPF:</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>Idade:</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>Celular:</label>
                <input type="text">
            </div>

            <div class="form-group" style="grid-row: span 2;">
                <label>Observação para barbeiro:</label>
                <textarea></textarea>
            </div>

            <div class="form-group">
                <label>E-mail:</label>
                <input type="email">
            </div>

            <div class="btn-container">
                <button type="submit" class="btn-save">Salvar</button>
            </div>
        </form>
    </main>

</body>
</html>