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

        /* --- Layout Principal --- */
        .app-container {
            display: grid;
            grid-template-columns: 260px 1fr 320px;
            grid-template-rows: auto 1fr;
            grid-template-areas:
                "sidebar topbar notifications"
                "sidebar main notifications";
            height: 100vh;
        }

        /* --- Barra Lateral de Navegação (Esquerda) --- */
        .sidebar {
            grid-area: sidebar;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin-bottom: 20px;
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

        .main-nav a {
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

        .main-nav a:hover {
            background-color: var(--main-bg);
            color: var(--text-dark);
        }

        .main-nav a.active {
            background-color: var(--primary-color);
            color: white;
        }

        .main-nav a i {
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

        /* --- Topbar --- */
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

        .topbar .breadcrumbs {
            color: var(--text-light);
        }

        .topbar .topbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 1.2rem;
        }

        /* --- Conteúdo Principal --- */
        .main-content {
            grid-area: main;
            padding: 25px;
            overflow-y: auto;
        }

        .main-content h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        /* Animações de Entrada (NOVO) */
        @keyframes card-entry {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

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
            opacity: 0;
            animation: card-entry 0.5s ease-out forwards;
        }

        .kpi-card .label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .kpi-card .value {
            font-size: 2rem;
            font-weight: 700;
        }

        .kpi-card .change {
            font-weight: 500;
        }

        .kpi-card.income {
            background-color: var(--income-color);
            animation-delay: 0.1s;
        }

        .kpi-card.expense {
            background-color: var(--expense-color);
            animation-delay: 0.2s;
        }

        .kpi-card.goals {
            background-color: var(--goal-color);
            animation-delay: 0.3s;
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
            opacity: 0;
            animation: card-entry 0.5s ease-out forwards;
        }

        /* Atraso na animação dos cards de gráficos */
        .charts-grid>.card:nth-child(1) {
            animation-delay: 0.4s;
        }

        .charts-grid>.card:nth-child(2) {
            animation-delay: 0.5s;
        }

        .charts-grid>.card:nth-child(3) {
            animation-delay: 0.6s;
        }

        .charts-grid>.card:nth-child(4) {
            animation-delay: 0.7s;
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

        .card-body svg {
            width: 100%;
            height: auto;
        }

        /* --- Barra de Notificações (Direita) --- */
        .notifications-sidebar {
            grid-area: notifications;
            background-color: var(--card-bg);
            border-left: 1px solid var(--border-color);
            padding: 20px;
            overflow-y: auto;
        }

        .notifications-sidebar h3 {
            margin-bottom: 15px;
        }

        .notification-list,
        .achievement-list {
            list-style: none;
            margin-bottom: 25px;
        }

        .notification-item,
        .achievement-item {
            display: flex;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .notification-item:last-child,
        .achievement-item:last-child {
            border-bottom: none;
        }

        .item-icon {
            font-size: 1.2rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .icon-trophy {
            background: #fff4d8;
            color: #ffb400;
        }

        .icon-user {
            background: #eaf2ff;
            color: #5a8dd4;
        }

        .icon-check {
            background: #e2f5ea;
            color: var(--income-color);
        }

        .icon-info {
            background: #e4e6e8;
            color: var(--text-light);
        }

        .item-content .title {
            font-weight: 600;
        }

        .item-content .time {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        /* Card de Balanço de Categorias (NOVO) */
        .category-balance-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .category-item-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .category-item-info .name {
            font-weight: 500;
        }

        .category-item-info .values {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: var(--border-color);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--primary-color);
            border-radius: 4px;
        }

        /* Responsividade */
        @media (max-width: 1400px) {
            .app-container {
                grid-template-columns: 240px 1fr 280px;
            }
        }

        @media (max-width: 1200px) {
            .app-container {
                grid-template-columns: 220px 1fr;
                grid-template-areas: "sidebar topbar" "sidebar main";
            }

            .notifications-sidebar {
                display: none;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .app-container {
                grid-template-columns: 1fr;
                grid-template-areas: "topbar" "main";
            }

            .sidebar {
                display: none;
            }

            .kpi-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="app-container">
        <aside class="sidebar">
            <div class="user-profile">
                <img src="https://i.pravatar.cc/40?u=anthoni" alt="Avatar do Usuário">
                <span>Anthoni da Luz</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#" class="active"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fa-solid fa-money-bill-transfer"></i> Lançamentos</a></li>
                    <li><a href="#"><i class="fa-solid fa-crosshairs"></i> Metas</a></li>
                    <li><a href="#"><i class="fa-solid fa-chart-pie"></i> Relatórios</a></li>
                    <li><a href="#"><i class="fa-solid fa-lightbulb"></i> Dicas Financeiras</a></li>
                    <li><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <nav class="main-nav">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
                    </ul>
                </nav>
                <h1 class="logo">Finance Vision</h1>
            </div>
        </aside>

        <header class="topbar">
            <div class="breadcrumbs">Dashboards / Padrão</div>
            <div class="topbar-actions">
                <i class="fa-regular fa-sun"></i><i class="fa-regular fa-clock"></i><i class="fa-regular fa-bell"></i><i
                    class="fa-solid fa-expand"></i>
            </div>
        </header>

        <main class="main-content">
            <h2>Visualização</h2>
            <div class="kpi-cards">
                <div class="kpi-card income">
                    <p class="label">Receitas</p>
                    <p class="value">R$ 929,00</p>
                    <p class="change">+11.01%</p>
                </div>
                <div class="kpi-card expense">
                    <p class="label">Despesas</p>
                    <p class="value">R$ 214,99</p>
                    <p class="change">-0.03%</p>
                </div>
                <div class="kpi-card goals">
                    <p class="label">Progresso de Metas</p>
                    <p class="value">R$ 29,72</p>
                    <p class="change">7.2%</p>
                </div>
            </div>

            <div class="charts-grid">
                <div class="card full-width-chart">
                    <div class="card-header">
                        <h3>Evolução do Saldo</h3>
                    </div>
                    <div class="card-body">
                        <svg viewBox="0 0 500 200" preserveAspectRatio="none">
                            <path d="M0,100 C50,50 100,120 150,80 S250,20 300,90 S400,180 450,150 L500,160" fill="none"
                                stroke="#3498db" stroke-width="3" />
                            <path d="M0,120 C50,150 100,80 150,110 S250,180 300,120 S400,50 450,80 L500,70" fill="none"
                                stroke="#bdc3c7" stroke-width="3" stroke-dasharray="5,5" />
                            <line x1="0" y1="190" x2="500" y2="190" stroke="#eeeeee" stroke-width="1" /><text x="20"
                                y="198" font-size="12" fill="#95a5a6">Jan</text><text x="90" y="198" font-size="12"
                                fill="#95a5a6">Feb</text><text x="160" y="198" font-size="12"
                                fill="#95a5a6">Mar</text><text x="230" y="198" font-size="12"
                                fill="#95a5a6">Apr</text><text x="300" y="198" font-size="12"
                                fill="#95a5a6">Maio</text><text x="370" y="198" font-size="12"
                                fill="#95a5a6">Jun</text><text x="440" y="198" font-size="12" fill="#95a5a6">Jul</text>
                        </svg>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Balanço por Categoria</h3>
                    </div>
                    <div class="card-body">
                        <ul class="category-balance-list">
                            <li>
                                <div class="category-item-info"><span class="name">Alimentação</span><span
                                        class="values">R$ 450 / R$ 800</span></div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 56%; background-color: #f1c40f;"></div>
                                </div>
                            </li>
                            <li>
                                <div class="category-item-info"><span class="name">Lazer</span><span class="values">R$
                                        120 / R$ 300</span></div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 40%; background-color: #1abc9c;"></div>
                                </div>
                            </li>
                            <li>
                                <div class="category-item-info"><span class="name">Assinaturas</span><span
                                        class="values">R$ 95 / R$ 100</span></div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 95%; background-color: #e74c3c;"></div>
                                </div>
                            </li>
                            <li>
                                <div class="category-item-info"><span class="name">Transporte</span><span
                                        class="values">R$ 80 / R$ 150</span></div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 53%; background-color: #9b59b6;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Desempenho</h3>
                    </div>
                    <div class="card-body">
                        <svg viewBox="0 0 200 100" preserveAspectRatio="none">
                            <rect x="10" y="50" width="15" height="50" fill="#3498db" rx="3" />
                            <rect x="40" y="20" width="15" height="80" fill="#2ecc71" rx="3" />
                            <rect x="70" y="40" width="15" height="60" fill="#3498db" rx="3" />
                            <rect x="100" y="10" width="15" height="90" fill="#2ecc71" rx="3" />
                            <rect x="130" y="70" width="15" height="30" fill="#e74c3c" rx="3" />
                            <rect x="160" y="30" width="15" height="70" fill="#2ecc71" rx="3" />
                            <line x1="0" y1="100" x2="200" y2="100" stroke="#eeeeee" stroke-width="1" />
                        </svg>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Despesas por Categoria</h3>
                    </div>
                    <div class="card-body" style="display:flex; align-items:center; gap: 20px;">
                        <svg viewBox="0 0 100 100" width="120" height="120">
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#e67e22" stroke-width="10"
                                stroke-dasharray="87.96 282.74" transform="rotate(-90 50 50)" />
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#2ecc71" stroke-width="10"
                                stroke-dasharray="144.51 282.74" stroke-dashoffset="-87.96"
                                transform="rotate(-90 50 50)" />
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#3498db" stroke-width="10"
                                stroke-dasharray="50.26 282.74" stroke-dashoffset="-232.47"
                                transform="rotate(-90 50 50)" />
                        </svg>
                        <ul style="list-style:none; padding-left:0; flex-grow:1;">
                            <li style="display:flex; align-items:center; gap:8px; margin-bottom:5px;">
                                <div style="width:10px; height:10px; border-radius:50%; background:#3498db;"></div>
                                Compras: 52.1%
                            </li>
                            <li style="display:flex; align-items:center; gap:8px; margin-bottom:5px;">
                                <div style="width:10px; height:10px; border-radius:50%; background:#2ecc71;"></div>
                                Mercado: 22.8%
                            </li>
                            <li style="display:flex; align-items:center; gap:8px; margin-bottom:5px;">
                                <div style="width:10px; height:10px; border-radius:50%; background:#e67e22;"></div>
                                Assinaturas: 13.9%
                            </li>
                            <li style="display:flex; align-items:center; gap:8px;">
                                <div style="width:10px; height:10px; border-radius:50%; background:#7f8c8d;"></div>
                                Outros: 11.2%
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <aside class="notifications-sidebar">
            <h3>Notificações</h3>
            <ul class="notification-list">
                <li class="notification-item">
                    <div class="item-icon icon-trophy"><i class="fa-solid fa-trophy"></i></div>
                    <div class="item-content">
                        <p class="title">Você ganhou uma conquista!</p>
                        <p class="time">Agora mesmo</p>
                    </div>
                </li>
                <li class="notification-item">
                    <div class="item-icon icon-user"><i class="fa-solid fa-user"></i></div>
                    <div class="item-content">
                        <p class="title">Perfil Atualizado</p>
                        <p class="time">59 minutos atrás</p>
                    </div>
                </li>
                <li class="notification-item">
                    <div class="item-icon icon-info"><i class="fa-regular fa-credit-card"></i></div>
                    <div class="item-content">
                        <p class="title">Seu cartão vence hoje!</p>
                        <p class="time">12 horas atrás</p>
                    </div>
                </li>
            </ul>
            <h3>Conquistas</h3>
            <ul class="achievement-list">
                <li class="achievement-item">
                    <div class="item-icon icon-check"><i class="fa-solid fa-check"></i></div>
                    <div class="item-content">
                        <p class="title">Meta atingida com sucesso.</p>
                        <p class="time">Agora mesmo</p>
                    </div>
                </li>
                <li class="achievement-item">
                    <div class="item-icon icon-check"><i class="fa-solid fa-fire"></i></div>
                    <div class="item-content">
                        <p class="title">7 dias seguidos de uso.</p>
                        <p class="time">Você acessou o Finance Vision...</p>
                    </div>
                </li>
            </ul>
        </aside>
    </div>
</body>

</html>