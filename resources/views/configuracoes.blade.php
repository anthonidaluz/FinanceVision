<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Finance Vision</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* --- Reset e Estilos Globais --- */
        :root {
            --primary-color: #3498DB;
            --light-primary-color: #eaf2ff;
            --text-color: #343a40;
            --subtle-text-color: #6c757d;
            --border-color: #e9ecef;
            --background-color: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        /* --- Estrutura da Página --- */
        .page-container {
            max-width: 800px;
            /* Largura máxima para melhor legibilidade */
            margin: 0 auto;
            padding: 30px 20px;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .back-arrow {
            font-size: 1.5rem;
            color: var(--text-color);
            text-decoration: none;
        }

        .header-logo {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .main-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 40px;
        }

        /* --- Cards de Configuração --- */
        .settings-form {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .settings-card {
            background-color: #fff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 25px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .card-header i {
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .card-header h2 {
            font-size: 1.3rem;
            font-weight: 600;
        }

        /* --- Inputs e Formulários --- */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--subtle-text-color);
            margin-bottom: 8px;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 12px 15px;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .input-group input:focus,
        .input-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        /* --- Toggles de Notificação --- */
        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .notification-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .notification-list .notification-toggle:last-child {
            border-bottom: none;
        }

        .notification-toggle span {
            font-weight: 500;
        }

        .toggle-buttons {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
        }

        .toggle-buttons input[type="radio"] {
            display: none;
        }

        .toggle-buttons label {
            padding: 6px 18px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--subtle-text-color);
            transition: background-color 0.3s;
        }

        .toggle-buttons label:first-of-type {
            border-right: 1px solid var(--border-color);
        }

        .toggle-buttons input[type="radio"]:checked+label {
            background-color: var(--primary-color);
            color: #fff;
        }

        /* --- Botão Salvar --- */
        .save-button-container {
            text-align: center;
            margin-top: 10px;
        }

        .btn-save {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 14px 70px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-save:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <header class="page-header">
            <a href="{{ route('dashboard') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <span class="header-logo">Finance Vision</span>
        </header>

        <h1 class="main-title">Configurações</h1>

        <form class="settings-form" action="#" method="POST">
            <section class="settings-card">
                <div class="card-header">
                    <i class="fa-solid fa-user-pen"></i>
                    <h2>Perfil do Usuário</h2>
                </div>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="name">Seu Nome</label>
                        <input type="text" id="name" name="name" placeholder="Fulano da Silva">
                    </div>
                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com">
                    </div>
                    <div class="input-group">
                        <label for="birthdate">Data de Aniversário</label>
                        <input type="date" id="birthdate" name="birthdate">
                    </div>
                </div>
            </section>

            <section class="settings-card">
                <div class="card-header">
                    <i class="fa-solid fa-lock"></i>
                    <h2>Alterar Senha</h2>
                </div>
                <div class="input-group">
                    <label for="current_password">Senha Atual</label>
                    <input type="password" id="current_password" name="current_password"
                        placeholder="Digite sua senha atual">
                </div>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="new_password">Nova Senha</label>
                        <input type="password" id="new_password" name="new_password" placeholder="••••••••">
                    </div>
                    <div class="input-group">
                        <label for="new_password_confirmation">Confirmar Nova Senha</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            placeholder="••••••••">
                    </div>
                </div>
            </section>

            <section class="settings-card">
                <div class="card-header">
                    <i class="fa-solid fa-bell"></i>
                    <h2>Notificações</h2>
                </div>
                <div class="notification-list">
                    <div class="notification-toggle">
                        <span>Dicas Financeiras</span>
                        <div class="toggle-buttons">
                            <input type="radio" id="dicas_sim" name="dicas" value="sim" checked>
                            <label for="dicas_sim">SIM</label>
                            <input type="radio" id="dicas_nao" name="dicas" value="nao">
                            <label for="dicas_nao">NÃO</label>
                        </div>
                    </div>
                    <div class="notification-toggle">
                        <span>Alerta de Gastos</span>
                        <div class="toggle-buttons">
                            <input type="radio" id="gastos_sim" name="gastos" value="sim" checked>
                            <label for="gastos_sim">SIM</label>
                            <input type="radio" id="gastos_nao" name="gastos" value="nao">
                            <label for="gastos_nao">NÃO</label>
                        </div>
                    </div>
                    <div class="notification-toggle">
                        <span>Lembrete de Metas</span>
                        <div class="toggle-buttons">
                            <input type="radio" id="conquistas_sim" name="conquistas" value="sim" checked>
                            <label for="conquistas_sim">SIM</label>
                            <input type="radio" id="conquistas_nao" name="conquistas" value="nao">
                            <label for="conquistas_nao">NÃO</label>
                        </div>
                    </div>
                </div>
            </section>

            <section class="settings-card">
                <div class="card-header">
                    <i class="fa-solid fa-paper-plane"></i>
                    <h2>Feedback e Suporte</h2>
                </div>
                <div class="input-group">
                    <label for="feedback">Sua opinião é importante! Envie-nos uma sugestão ou relate um
                        problema.</label>
                    <textarea id="feedback" name="feedback" placeholder="Digite sua mensagem aqui..."></textarea>
                </div>
            </section>

            <div class="save-button-container">
                <button type="submit" class="btn-save">Salvar Alterações</button>
            </div>
        </form>
    </div>
</body>

</html>