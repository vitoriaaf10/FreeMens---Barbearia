<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$nome_usuario = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Usuário';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Free Men's Barbearia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <aside class="sidebar">
        <div class="logo-area">
            <div class="logo-symbol">FM</div>
            <div class="logo-text">FREE MEN'S</div>
            <div class="logo-sub">
                <i class="fa-solid fa-scissors"></i> BARBEARIA
            </div>
        </div>

        <ul class="menu">
            <li><a href="perfil.php" class="active"><i class="fa-solid fa-user"></i> Meu perfil</a></li>
            <li><a href="agendamentos.php"><i class="fa-solid fa-book"></i> Agendamentos</a></li>
            <li><a href="calendario.php"><i class="fa-solid fa-calendar"></i> Calendário</a></li>
        </ul>

        <div class="sidebar-footer" onclick="location.href='../backend/logout.php'">
            <i class="fa-solid fa-bars"></i>
        </div>
    </aside>

    <main class="main-content">
        <h1 class="header-title">
            <i class="fa-solid fa-user"></i> Meu Perfil
        </h1>

        <div class="em-desenvolvimento">
            <i class="fa-solid fa-wrench"></i>
            <p>Em desenvolvimento</p>
        </div>
    </main>
</body>
</html>

