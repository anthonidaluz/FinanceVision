<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - Finance Vision</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary-color: #3498DB;
            --text-color-dark: #2c3e50;
            --text-color-light: #7f8c8d;
            --border-color: #dfe4ea;
            --background-color: #f8f9fa;
            --white-color: #ffffff;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
        }

        /* --- Reset e Estilos Globais --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color-dark);
        }

        /* --- Layout Principal --- */
        .main-container {
            display: flex;
            height: 100vh;
            /* Alterado para ocupar a altura da tela */
            overflow: hidden;
            /* Evita qualquer rolagem no container principal */
        }

        .report-panel {
            flex-basis: 500px;
            flex-shrink: 0;
            background-color: var(--white-color);
            padding: 25px 35px;
            /* Padding reduzido */
            display: flex;
            flex-direction: column;
        }

        .image-section {
            flex-grow: 1;
            background-image: url('/images/trelatorio.png');
            background-size: cover;
            background-position: center;
        }

        /* --- Cabeçalho do Painel --- */
        .page-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .back-arrow {
            font-size: 1.6rem;
            color: var(--text-color-dark);
            text-decoration: none;
        }

        .header-logo {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .panel-title {
            font-size: 2.5rem;
            font-weight: 600;
            margin: 15px 0 25px 0;
            /* Margem reduzida */
        }

        /* --- Controles do Formulário --- */
        .filters-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
            /* Margem reduzida */
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-color-light);
        }

        .input-group select {
            width: 100%;
            padding: 10px 15px 10px 40px;
            /* Padding reduzido */
            font-size: 0.9rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            appearance: none;
            background-color: var(--white-color);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        /* --- Opções de Rádio --- */
        .options-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
            /* Margem reduzida */
        }

        .radio-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            /* Margem reduzida */
        }

        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group label {
            cursor: pointer;
            padding-left: 28px;
            position: relative;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .radio-group label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            background-color: var(--white-color);
        }

        .radio-group label::after {
            content: '';
            position: absolute;
            left: 5px;
            /* Ajustado */
            top: 50%;
            transform: translateY(-50%) scale(0);
            width: 8px;
            /* Reduzido */
            height: 8px;
            /* Reduzido */
            border-radius: 50%;
            background-color: var(--primary-color);
            transition: transform 0.2s ease;
        }

        .radio-group input[type="radio"]:checked+label::before {
            border-color: var(--primary-color);
        }

        .radio-group input[type="radio"]:checked+label::after {
            transform: translateY(-50%) scale(1);
        }

        /* --- Card do Gráfico --- */
        .chart-preview-card {
            background-color: var(--white-color);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 15px;
            /* Padding reduzido */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            margin-bottom: 25px;
            /* Margem reduzida */
        }

        .chart-legend {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        .dot-receitas {
            background-color: var(--success-color);
        }

        .dot-despesas {
            background-color: var(--danger-color);
        }

        .chart-caption {
            font-size: 0.75rem;
            color: var(--text-color-light);
            text-align: center;
            margin-top: 8px;
        }

        /* --- Botão Principal --- */
        .btn-generate {
            width: 100%;
            background-color: var(--primary-color);
            color: var(--white-color);
            border: none;
            padding: 14px;
            /* Padding reduzido */
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: auto;
            /* Empurra para o final do painel */
        }

        .btn-generate:hover {
            background-color: #2980b9;
        }

        /* --- Responsividade --- */
        @media (max-width: 992px) {
            .image-section {
                display: none;
            }

            .report-panel {
                flex-basis: 100%;
            }

            .main-container {
                height: auto;
                min-height: 100vh;
            }
        }

        @media (max-width: 576px) {
            .report-panel {
                padding: 20px;
            }

            .panel-title {
                font-size: 2.2rem;
            }

            .filters-container,
            .options-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <main class="main-container">
        <section class="report-panel">
            <header class="page-header">
                <a href="{{ route('dashboard') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
                <h1 class="header-logo">Finance Vision</h1>
            </header>

            <h2 class="panel-title">Relatórios</h2>

            <form action="#">
                <div class="filters-container">
                    <div class="input-group">
                        <i class="fa-regular fa-calendar"></i>
                        <select name="month">
                            <option>Selecione o Mês</option>
                            <option value="2025-07">Julho, 2025</option>
                            <option value="2025-06">Junho, 2025</option>
                            <option value="2025-05">Maio, 2025</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <i class="fa-solid fa-shapes"></i>
                        <select name="category">
                            <option>Categoria</option>
                            <option value="alimentacao">Alimentação</option>
                            <option value="transporte">Transporte</option>
                            <option value="lazer">Lazer</option>
                        </select>
                    </div>
                </div>

                <div class="options-container">
                    <div class="report-type-column">
                        <div class="radio-group">
                            <input type="radio" id="rel_simples" name="report_type" value="simples" checked>
                            <label for="rel_simples">Relatório simples</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" id="rel_padrao" name="report_type" value="padrao">
                            <label for="rel_padrao">Relatório padrão</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" id="rel_completo" name="report_type" value="completo">
                            <label for="rel_completo">Relatório completo</label>
                        </div>
                    </div>
                    <div class="report-format-column">
                        <div class="radio-group">
                            <input type="radio" id="format_pdf" name="report_format" value="pdf" checked>
                            <label for="format_pdf">PDF</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" id="format_csv" name="report_format" value="csv">
                            <label for="format_csv">CSV</label>
                        </div>
                    </div>
                </div>

                <div class="chart-preview-card">
                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-dot dot-receitas"></span> Receitas</div>
                        <div class="legend-item"><span class="legend-dot dot-despesas"></span> Despesas</div>
                    </div>
                    <svg viewBox="0 0 300 100" preserveAspectRatio="xMidYMid meet" aria-hidden="true" role="img">
                        <path d="M 10 70 L 40 40 L 70 55 L 100 45 L 130 65 L 160 50 L 190 60 L 220 75 L 250 55 L 280 65"
                            fill="none" stroke="#e74c3c" stroke-width="2" />
                        <path d="M 10 80 L 40 75 L 70 85 L 100 70 L 130 75 L 160 80 L 190 70 L 220 60 L 250 80 L 280 70"
                            fill="none" stroke="#2ecc71" stroke-width="2" />
                        <text x="10" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">J</text>
                        <text x="40" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">F</text>
                        <text x="70" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">M</text>
                        <text x="100" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">A</text>
                        <text x="130" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">M</text>
                        <text x="160" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">J</text>
                        <text x="190" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">J</text>
                        <text x="220" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">A</text>
                        <text x="250" y="98" font-family="Poppins" font-size="8" fill="#7f8c8d">S</text>
                    </svg>
                    <p class="chart-caption">Evolução de Receitas e Despesas</p>
                </div>

                <button type="submit" class="btn-generate">Gerar Relatório</button>
            </form>

        </section>
        <section class="image-section">
        </section>
    </main>

</body>

</html>