<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lançamentos - Finance Vision</title>

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
            --income-color: #28a745;
            --expense-color: #e74c3c;
        }

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

        .page-container {
            max-width: 1200px;
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

        .page-title {
            text-align: center;
            font-size: 2.8rem;
            font-weight: 600;
            margin: 20px 0 30px 0;
        }

        /* --- Card do Formulário --- */
        .form-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px 25px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-group label {
            font-weight: 500;
            font-size: 0.9rem;
            color: var(--text-dark);
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 10px 15px;
            font-size: 0.95rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .input-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            padding-right: 35px;
        }

        /* Toggle Receita/Despesa (NOVO) */
        .entry-type-toggle {
            display: flex;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .entry-type-toggle input[type="radio"] {
            display: none;
        }

        .entry-type-toggle label {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s, color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        #receita:checked~label[for="receita"] {
            background-color: var(--income-color);
            color: var(--white);
        }

        #despesa:checked~label[for="despesa"] {
            background-color: var(--expense-color);
            color: var(--white);
        }

        #receita:not(:checked)~label[for="despesa"]:hover,
        #despesa:not(:checked)~label[for="receita"]:hover {
            background-color: #f0f0f0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .full-width textarea {
            min-height: 80px;
            resize: vertical;
        }

        /* --- Seção Inferior --- */
        .bottom-section {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 25px;
            margin-top: 25px;
        }

        .card {
            background-color: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
        }

        /* Card de Importação */
        .import-card h4 {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .import-card p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .import-actions {
            display: flex;
            gap: 15px;
            margin: 20px 0;
        }

        /* Botão Secundário (NOVO) */
        .btn-secondary {
            flex: 1;
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background-color: var(--background-color);
            border-color: var(--text-light);
        }

        .import-card .note {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        /* Card de Últimos Lançamentos */
        .history-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .history-card-header h4 {
            font-size: 1.1rem;
        }

        .history-card-header a {
            font-size: 0.9rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .transaction-list {
            list-style: none;
        }

        .transaction-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .transaction-list li:last-child {
            border-bottom: none;
        }

        .transaction-icon {
            font-size: 1.2rem;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
        }

        .icon-compras {
            background-color: #eaf2ff;
            color: #5a8dd4;
        }

        .icon-online {
            background-color: #fff4d8;
            color: #ffb400;
        }

        .icon-poupanca {
            background-color: #e2f5ea;
            color: var(--income-color);
        }

        .transaction-details .name {
            font-weight: 600;
        }

        .transaction-details .description {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .transaction-info {
            text-align: right;
        }

        .transaction-info .category {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .transaction-info .value {
            font-weight: 600;
            font-size: 1rem;
        }

        .transaction-info .date {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .value.income {
            color: var(--income-color);
        }

        .value.expense {
            color: var(--expense-color);
        }

        /* Botão Salvar */
        .actions-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn-save {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 14px 60px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-save:hover {
            background-color: #2980b9;
        }

        /* Responsividade */
        @media (max-width: 1100px) {
            .form-card {
                grid-template-columns: 1fr 1fr;
            }

            .form-card .full-width {
                grid-column: 1 / -1;
            }

            .bottom-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .form-card {
                grid-template-columns: 1fr;
            }

            .page-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="page-container">
        <header class="page-header">
            <a href="{{ Route('dashboard') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <h1 class="header-logo">Finance Vision</h1>
        </header>
        <h2 class="page-title">Lançamentos</h2>

        <form action="#" method="POST">
            <section class="form-card">
                <div class="input-group">
                    <label>Forma de Lançamento</label>
                    <div class="entry-type-toggle">
                        <input type="radio" id="receita" name="tipo_lancamento" value="receita">
                        <label for="receita"><i class="fa-solid fa-arrow-up"></i> Receita</label>
                        <input type="radio" id="despesa" name="tipo_lancamento" value="despesa" checked>
                        <label for="despesa"><i class="fa-solid fa-arrow-down"></i> Despesa</label>
                    </div>
                </div>
                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome">
                </div>
                <div class="input-group">
                    <label for="valor">Valor</label>
                    <input type="text" id="valor" name="valor" placeholder="R$ 0,00">
                </div>
                <div class="input-group">
                    <label for="data">Data</label>
                    <input type="date" id="data" name="data">
                </div>
                <div class="input-group">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="categoria">
                        <option>Selecione o tipo</option>
                        <option>Alimentação</option>
                        <option>Transporte</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="meta">Vincular a uma meta (opcional)</label>
                    <select id="meta" name="meta">
                        <option>Selecione uma meta</option>
                        <option>Viagem para o Nordeste</option>
                        <option>Poupança</option>
                    </select>
                </div>
                <div class="input-group full-width">
                    <label for="descricao">Descrição (opcional)</label>
                    <textarea id="descricao" name="descricao"></textarea>
                </div>
            </section>

            <div class="bottom-section">
                <section class="card import-card">
                    <h4>Importar extrato bancário</h4>
                    <p>Selecione um arquivo PDF ou CSV</p>
                    <div class="import-actions">
                        <button type="button" class="btn-secondary"><i class="fa-solid fa-magnifying-glass-chart"></i>
                            Pré-visualizar</button>
                        <button type="button" class="btn-secondary"><i class="fa-solid fa-upload"></i> Importar</button>
                    </div>
                    <p class="note">Os dados não são salvos sem sua revisão.</p>
                </section>

                <section class="card history-card">
                    <div class="history-card-header">
                        <h4>Últimos Lançamentos</h4>
                        <a href="#">Ver Todos ></a>
                    </div>
                    <ul class="transaction-list">
                        <li class="transaction-item">
                            <div class="transaction-icon icon-compras"><i class="fa-solid fa-bag-shopping"></i></div>
                            <div class="transaction-details">
                                <p class="name">Compras da semana</p>
                                <p class="description">Supermercado Angeloni</p>
                            </div>
                            <div class="transaction-info">
                                <p class="category">Mercado</p>
                                <p class="value expense">- R$ 121,90</p>
                                <p class="date">22 Jul, 2025</p>
                            </div>
                        </li>
                        <li class="transaction-item">
                            <div class="transaction-icon icon-online"><i class="fa-solid fa-box"></i></div>
                            <div class="transaction-details">
                                <p class="name">Amazon / Livro</p>
                                <p class="description">"A Psicologia Financeira"</p>
                            </div>
                            <div class="transaction-info">
                                <p class="category">Compras Online</p>
                                <p class="value expense">- R$ 49,50</p>
                                <p class="date">20 Jul, 2025</p>
                            </div>
                        </li>
                        <li class="transaction-item">
                            <div class="transaction-icon icon-poupanca"><i class="fa-solid fa-piggy-bank"></i></div>
                            <div class="transaction-details">
                                <p class="name">Salário</p>
                                <p class="description">Adiantamento quinzenal</p>
                            </div>
                            <div class="transaction-info">
                                <p class="category">Receita</p>
                                <p class="value income">+ R$ 2.500,00</p>
                                <p class="date">15 Jul, 2025</p>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>

            <div class="actions-container">
                <button type="submit" class="btn-save">Salvar Lançamento</button>
            </div>
        </form>
    </div>
</body>

</html>