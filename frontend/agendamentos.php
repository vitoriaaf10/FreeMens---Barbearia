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
    <title>Agendamentos - Free Men's Barbearia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <aside class="sidebar">
        <div class="logo-area">
            <img src="/imagens/logo.png"/>
        </div>

        <ul class="menu">
            <li><a href="perfil.php"><i class="fa-solid fa-user"></i> Meu perfil</a></li>
            <li><a href="agendamentos.php" class="active"><i class="fa-solid fa-book"></i> Agendamentos</a></li>
            <li><a href="calendario.php"><i class="fa-solid fa-calendar"></i> Calendário</a></li>
        </ul>

        <div class="sidebar-footer" onclick="location.href='../backend/logout.php'">
            <i class="fa-solid fa-bars"></i>
        </div>
    </aside>

    <main class="main-content">
        <h1 class="header-title">
            <i class="fa-solid fa-book"></i> Agendamentos
        </h1>

        <?php if (isset($_SESSION['sucesso_agendamento'])): ?>
            <div class="alert alert-sucesso">
                <?php 
                echo $_SESSION['sucesso_agendamento']; 
                unset($_SESSION['sucesso_agendamento']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['erro_agendamento'])): ?>
            <div class="alert alert-erro">
                <?php 
                echo $_SESSION['erro_agendamento']; 
                unset($_SESSION['erro_agendamento']);
                ?>
            </div>
        <?php endif; ?>

        <div class="agendamentos-layout">
            <div class="novo-agendamento">
                <h2 class="section-title">Novo Agendamento</h2>
                <form action="../backend/processa_agendamento.php" method="POST" class="form-agendamento">
                    <div class="form-group-agenda">
                        <label for="data">Data</label>
                        <input type="date" id="data" name="data" required min="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group-agenda">
                        <label for="horario">Horário</label>
                        <select id="horario" name="horario" required>
                            <option value="">Selecione um horário</option>
                            <option value="08:00:00">08:00</option>
                            <option value="09:00:00">09:00</option>
                            <option value="10:00:00">10:00</option>
                            <option value="11:00:00">11:00</option>
                            <option value="12:00:00">12:00</option>
                            <option value="13:00:00">13:00</option>
                            <option value="14:00:00">14:00</option>
                            <option value="15:00:00">15:00</option>
                            <option value="16:00:00">16:00</option>
                            <option value="17:00:00">17:00</option>
                            <option value="18:00:00">18:00</option>
                            <option value="19:00:00">19:00</option>
                            <option value="20:00:00">20:00</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-agendar">Agendar</button>
                </form>
            </div>

            <div class="lista-agendamentos">
                <h2 class="section-title">Meus Agendamentos</h2>
                <div class="agendamentos-wrapper" id="agendamentosLista">
                    <div class="loading-message">Carregando agendamentos...</div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function carregarAgendamentos() {
            fetch('../backend/listar_agendamentos.php')
                .then(response => response.json())
                .then(data => {
                    const listaDiv = document.getElementById('agendamentosLista');
                    
                    if (data.sucesso) {
                        if (data.agendamentos.length === 0) {
                            listaDiv.innerHTML = '<div class="no-appointments">Você não tem agendamentos no momento.</div>';
                        } else {
                            let html = '<div class="agendamentos-grid">';
                            data.agendamentos.forEach(agendamento => {
                                const dataFormatada = new Date(agendamento.data + 'T00:00:00').toLocaleDateString('pt-BR');
                                const horarioFormatado = agendamento.horario.substring(0, 5);
                                
                                html += `
                                    <div class="agendamento-item ${agendamento.status}">
                                        <div class="agendamento-header">
                                            <i class="fa-solid fa-calendar-day"></i>
                                            <span class="agendamento-data">${dataFormatada}</span>
                                        </div>
                                        <div class="agendamento-info">
                                            <div class="info-row">
                                                <i class="fa-solid fa-clock"></i>
                                                <span>${horarioFormatado}</span>
                                            </div>
                                            <div class="info-row">
                                                <i class="fa-solid fa-cut"></i>
                                                <span>Corte de Cabelo</span>
                                            </div>
                                            <div class="status-badge status-${agendamento.status}">
                                                ${agendamento.status === 'reservado' ? 'Reservado' : 'Disponível'}
                                            </div>
                                        </div>
                                        ${agendamento.status === 'reservado' ? `
                                        <button onclick="cancelarAgendamento(${agendamento.id})" class="btn-cancelar">
                                            Cancelar
                                        </button>
                                        ` : ''}
                                    </div>
                                `;
                            });
                            html += '</div>';
                            listaDiv.innerHTML = html;
                        }
                    } else {
                        listaDiv.innerHTML = '<div class="error-message">Erro ao carregar agendamentos.</div>';
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    document.getElementById('agendamentosLista').innerHTML = 
                        '<div class="error-message">Erro ao carregar agendamentos.</div>';
                });
        }

        function cancelarAgendamento(id) {
            if (confirm('Tem certeza que deseja cancelar este agendamento?')) {
                fetch('../backend/cancelar_agendamento.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sucesso) {
                        carregarAgendamentos();
                        alert('Agendamento cancelado com sucesso!');
                    } else {
                        alert('Erro ao cancelar agendamento: ' + data.mensagem);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao cancelar agendamento.');
                });
            }
        }

        carregarAgendamentos();
        setInterval(carregarAgendamentos, 30000);
    </script>
</body>
</html>

