<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Finance Vision</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary-color: #3498DB;
            --sidebar-bg: #FFFFFF;
            --main-bg: #F4F7FC;
            --card-bg: #FFFFFF;
            --text-dark: #2c3e50;
            --text-light: #95a5a6;
            --border-color: #e9ecef;
            --income-color: #2ecc71;
            --expense-color: #e74c3c;
            --goal-color: #f1c40f;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--main-bg);
            color: var(--text-dark);
        }

        .app-container {
            display: grid;
            grid-template-columns: 260px 1fr 320px;
            grid-template-rows: auto 1fr;
            grid-template-areas:
                "sidebar topbar notifications"
                "sidebar main notifications";
            height: 100vh;
        }

        .sidebar {
            grid-area: sidebar;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .user-profile-link {
            text-decoration: none;
            color: inherit;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .user-profile:hover {
            background-color: var(--main-bg);
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ccc;
        }

        .user-profile span {
            font-weight: 600;
        }

        .main-nav ul {
            list-style: none;
        }

        .main-nav a,
        .logout-form a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            margin: 5px 0;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            transition: background-color 0.2s, color 0.2s;
        }

        .main-nav a:hover,
        .logout-form a:hover {
            background-color: var(--main-bg);
            color: var(--text-dark);
        }

        .main-nav a.active {
            background-color: var(--primary-color);
            color: white;
        }

        .main-nav a i,
        .logout-form a i {
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            margin-top: auto;
            text-align: center;
        }

        .sidebar-footer .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .topbar {
            grid-area: topbar;
            background-color: var(--card-bg);
            padding: 0 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            height: 70px;
        }

        .main-content {
            grid-area: main;
            padding: 25px;
            overflow-y: auto;
        }

        .notifications-sidebar {
            grid-area: notifications;
            background-color: var(--card-bg);
            border-left: 1px solid var(--border-color);
            padding: 20px;
            overflow-y: auto;
        }

        /* Adicione o resto do seu CSS extenso aqui... */
        .kpi-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .kpi-card {
            padding: 20px;
            border-radius: 12px;
            color: white;
        }

        .kpi-card .label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .kpi-card .value {
            font-size: 2rem;
            font-weight: 700;
        }

        .kpi-card.income {
            background-color: var(--income-color);
        }

        .kpi-card.expense {
            background-color: var(--expense-color);
        }

        .kpi-card.goals {
            background-color: var(--goal-color);
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h3 {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="app-container">
        <aside class="sidebar">
            <a href="{{ route('profile.edit') }}" class="user-profile-link">
                <div class="user-profile">
                    <img src="https://i.pravatar.cc/40?u={{ Auth::user()->email }}" alt="Avatar do Usuário">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </a>
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i
                                class="fa-solid fa-house"></i> Dashboard</a></li>
                    <li><a href="{{ route('lancamentos.index') }}"
                            class="{{ request()->routeIs('lancamentos.*') ? 'active' : '' }}"><i
                                class="fa-solid fa-money-bill-transfer"></i> Lançamentos</a></li>
                    <li><a href="{{ route('metas') }}" class="{{ request()->routeIs('metas') ? 'active' : '' }}"><i
                                class="fa-solid fa-crosshairs"></i> Metas</a></li>
                    <li><a href="{{ route('relatorios') }}"
                            class="{{ request()->routeIs('relatorios') ? 'active' : '' }}"><i
                                class="fa-solid fa-chart-pie"></i> Relatórios</a></li>
                    <li><a href="{{ route('dicas') }}" class="{{ request()->routeIs('dicas') ? 'active' : '' }}"><i
                                class="fa-solid fa-lightbulb"></i> Dicas Financeiras</a></li>
                    <li><a href="{{ route('configuracoes') }}"
                            class="{{ request()->routeIs('configuracoes') ? 'active' : '' }}"><i
                                class="fa-solid fa-gear"></i> Configurações</a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <nav class="main-nav">
                    <ul>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> Sair
                                </a>
                            </form>
                        </li>
                    </ul>
                </nav>
                <h1 class="logo">Finance Vision</h1>
            </div>
        </aside>

        <header class="topbar"></header>

        <main class="main-content">
            <h2>Visualização</h2>
            <div class="kpi-cards">
                <div class="kpi-card income">
                    <p class="label">Receitas</p>
                    <p class="value">R$ {{ number_format($totalReceitas ?? 0, 2, ',', '.') }}</p>
                </div>
                <div class="kpi-card expense">
                    <p class="label">Despesas</p>
                    <p class="value">R$ 214,99</p>
                </div>
                <div class="kpi-card goals">
                    <p class="label">Progresso de Metas</p>
                    <p class="value">R$ 29,72</p>
                </div>
            </div>
            <div class="charts-grid">
                <div class="card"> ... </div>
                <div class="card"> ... </div>
            </div>
        </main>

        <aside class="notifications-sidebar">
            <h3>Notificações</h3>
            <ul class="notification-list"> ... </ul>
            <h3>Conquistas</h3>
            <ul class="achievement-list"> ... </ul>
        </aside>
    </div>
</body>

</html>