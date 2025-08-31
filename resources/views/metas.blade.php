<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Metas - Finance Vision</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary-color: #3498DB;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #e9ecef;
            --background-color: #f8f9fa;
            --white: #ffffff;
            --status-progress: #ffc107;
            /* Amarelo */
            --status-completed: #28a745;
            /* Verde */
            --danger-color: #e74c3c;
            /* Vermelho para Excluir e Restante do gráfico */
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
            color: var(--text-dark);
        }

        /* --- Estrutura da Página --- */
        .page-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 30px;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .back-arrow {
            font-size: 1.8rem;
            color: var(--text-dark);
            text-decoration: none;
        }

        .header-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .title-wrapper {
            text-align: center;
            margin: 20px 0 30px 0;
        }

        .title-wrapper h2 {
            font-size: 2.8rem;
            font-weight: 600;
        }

        .filters-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .filter-group {
            position: relative;
        }

        .filter-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .filter-group select {
            width: 220px;
            padding: 10px 15px 10px 40px;
            font-size: 0.95rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            appearance: none;
            background-color: var(--white);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        /* --- Grid de Metas --- */
        .goals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(550px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        /* --- Card de Meta --- */
        .goal-card {
            background-color: var(--white);
            border-radius: 12px;
            border: 2px solid var(--border-color);
            padding: 25px;
            display: flex;
            gap: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .goal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .goal-card.status-progress {
            border-color: var(--status-progress);
        }

        .goal-card.status-completed {
            border-color: var(--status-completed);
        }

        .goal-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .goal-info h3 {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 15px;
        }

        .goal-info p {
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .goal-info p strong {
            font-weight: 600;
            color: var(--text-dark);
        }

        .goal-info .category-icon {
            margin-left: 8px;
            color: var(--text-light);
        }

        /* Ícone de Categoria */

        .goal-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .goal-actions .btn {
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .goal-actions .btn-edit {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .goal-actions .btn-delete {
            background-color: transparent;
            color: var(--danger-color);
            border: 2px solid var(--danger-color);
        }

        /* Gráfico Circular e Tooltip */
        .goal-chart {
            width: 150px;
            flex-shrink: 0;
            position: relative;
        }

        /* Posição relativa para o tooltip */

        /* Tooltip (NOVO) */
        .goal-chart::before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 105%;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--text-dark);
            color: var(--white);
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.85rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s, visibility 0.2s;
            z-index: 10;
        }

        .goal-chart:hover::before {
            opacity: 1;
            visibility: visible;
        }

        .chart-legend {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 0.8rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        .dot-completed {
            background-color: var(--status-completed);
        }

        .dot-remaining {
            background-color: var(--danger-color);
        }

        @property --p {
            /* Habilita a animação da propriedade customizada */
            syntax: '<number>';
            inherits: false;
            initial-value: 0;
        }

        .donut-chart {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            position: relative;
            background: conic-gradient(var(--status-completed) 0% calc(var(--p) * 1%),
                    var(--danger-color) calc(var(--p) * 1%) 100%);
            display: flex;
            /* Para centralizar o percentual */
            justify-content: center;
            align-items: center;
            transition: --p 1s ease-out;
            /* Animação */
        }

        .donut-chart::after {
            content: '';
            position: absolute;
            width: 80%;
            height: 80%;
            background: var(--white);
            border-radius: 50%;
        }

        .chart-percentage {
            /* Percentual dentro do gráfico */
            position: relative;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Card de Adicionar Meta */
        .add-goal-card {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            border: 2px dashed var(--primary-color);
            border-radius: 12px;
            min-height: 200px;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .add-goal-card:hover {
            background-color: #eaf2ff;
        }

        /* Responsividade */
        @media(max-width: 1200px) {
            .goals-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .filters-container {
                flex-direction: column;
                align-items: center;
            }

            .filter-group select {
                width: 100%;
                max-width: 300px;
            }

            .goal-card {
                flex-direction: column;
            }

            .goal-chart {
                align-self: center;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="page-container">
        <header class="page-header">
            <a href="{{ route('dashboard') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <h1 class="header-logo">Finance Vision</h1>
        </header>

        <div class="title-wrapper">
            <h2>Minhas Metas Financeiras</h2>
            <div class="filters-container">
                <div class="filter-group">
                    <i class="fa-regular fa-calendar"></i>
                    <select>
                        <option>Selecione o prazo</option>
                        <option>Curto Prazo</option>
                        <option>Médio Prazo</option>
                        <option>Longo Prazo</option>
                    </select>
                </div>
                <div class="filter-group">
                    <i class="fa-solid fa-list-check"></i>
                    <select>
                        <option>Status</option>
                        <option>Em Progresso</option>
                        <option>Concluída</option>
                    </select>
                </div>
            </div>
        </div>

        <main class="goals-grid">
            <article class="goal-card status-progress">
                <div class="goal-info">
                    <h3>META 1</h3>
                    <p><strong>Título:</strong> Viagem para o Nordeste</p>
                    <p><strong>Status:</strong> Em Progresso...</p>
                    <p><strong>Objetivo:</strong> R$ 4.000,00</p>
                    <p><strong>Poupado:</strong> R$ 3.270,00</p>
                    <p><strong>Prazo:</strong> Até 10/2025</p>
                    <p><strong>Categoria:</strong> Viagem<i class="fa-solid fa-plane-departure category-icon"></i></p>
                    <div class="goal-actions">
                        <a href="#" class="btn btn-edit"><i class="fa-solid fa-pencil"></i> EDITAR</a>
                        <a href="#" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> EXCLUIR</a>
                    </div>
                </div>
                <div class="goal-chart" data-tooltip="Poupado: R$ 3.270,00 de R$ 4.000,00">
                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-dot dot-completed"></span> Concluído</div>
                        <div class="legend-item"><span class="legend-dot dot-remaining"></span> Restante</div>
                    </div>
                    <div class="donut-chart" style="--p: 81.75;">
                        <span class="chart-percentage">82%</span>
                    </div>
                </div>
            </article>

            <article class="goal-card status-progress">
                <div class="goal-info">
                    <h3>META 2</h3>
                    <p><strong>Título:</strong> Poupança</p>
                    <p><strong>Status:</strong> Em Progresso...</p>
                    <p><strong>Objetivo:</strong> R$ 10.000,00</p>
                    <p><strong>Poupado:</strong> R$ 2.750,00</p>
                    <p><strong>Prazo:</strong> Até 12/2025</p>
                    <p><strong>Categoria:</strong> Poupança<i class="fa-solid fa-piggy-bank category-icon"></i></p>
                    <div class="goal-actions">
                        <a href="#" class="btn btn-edit"><i class="fa-solid fa-pencil"></i> EDITAR</a>
                        <a href="#" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> EXCLUIR</a>
                    </div>
                </div>
                <div class="goal-chart" data-tooltip="Poupado: R$ 2.750,00 de R$ 10.000,00">
                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-dot dot-completed"></span> Concluído</div>
                        <div class="legend-item"><span class="legend-dot dot-remaining"></span> Restante</div>
                    </div>
                    <div class="donut-chart" style="--p: 27.5;">
                        <span class="chart-percentage">28%</span>
                    </div>
                </div>
            </article>

            <article class="goal-card status-completed">
                <div class="goal-info">
                    <h3>META 3</h3>
                    <p><strong>Título:</strong> Celular</p>
                    <p><strong>Status:</strong> Concluída</p>
                    <p><strong>Objetivo:</strong> R$ 2.999,00</p>
                    <p><strong>Poupado:</strong> R$ 2.999,00</p>
                    <p><strong>Prazo:</strong> Até 06/2025</p>
                    <p><strong>Categoria:</strong> Compras<i class="fa-solid fa-cart-shopping category-icon"></i></p>
                    <div class="goal-actions">
                        <a href="#" class="btn btn-edit"><i class="fa-solid fa-pencil"></i> EDITAR</a>
                        <a href="#" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> EXCLUIR</a>
                    </div>
                </div>
                <div class="goal-chart" data-tooltip="Meta concluída!">
                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-dot dot-completed"></span> Concluído</div>
                    </div>
                    <div class="donut-chart" style="--p: 100;">
                        <span class="chart-percentage">100%</span>
                    </div>
                </div>
            </article>

            <a href="#" class="add-goal-card">
                <i class="fa-solid fa-plus"></i>
                <span>Adicionar nova meta</span>
            </a>

        </main>
    </div>

    <script>
        // Pequeno script para ativar a animação após o carregamento da página
        // Isso garante que a transição do CSS funcione corretamente
        document.addEventListener('DOMContentLoaded', () => {
            const charts = document.querySelectorAll('.donut-chart');
            // Força um reflow, garantindo que a transição de --p seja aplicada
            charts.forEach(chart => {
                const percentage = chart.style.getPropertyValue('--p');
                chart.style.setProperty('--p', 0);
                setTimeout(() => {
                    chart.style.setProperty('--p', percentage);
                }, 100);
            });
        });
    </script>

</body>

</html>