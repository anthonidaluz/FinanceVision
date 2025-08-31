<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dicas Financeiras - Finance Vision</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            color: #343a40;
            line-height: 1.7;
        }

        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        /* --- Cabeçalho --- */
        .page-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .back-arrow {
            font-size: 1.8rem;
            color: #333;
            text-decoration: none;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 600;
        }

        /* --- Abas de Navegação --- */
        .tabs-nav {
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 40px;
        }

        .tabs-nav ul {
            display: flex;
            list-style: none;
            gap: 40px;
        }

        .tabs-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 5px;
            text-decoration: none;
            color: #6c757d;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            transition: color 0.3s, border-color 0.3s;
        }

        .tabs-nav a:hover {
            color: #3498DB;
        }

        .tabs-nav a.active {
            color: #3498DB;
            border-bottom-color: #3498DB;
        }

        .tabs-nav i {
            font-size: 1.2rem;
        }

        /* --- Grid de Conteúdo --- */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            align-items: start;
        }

        /* --- Cards de Informação --- */
        .info-card {
            padding: 30px;
            border-radius: 12px;
            height: 100%;
        }

        .info-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #495057;
        }

        .info-card h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .info-card ul {
            list-style-position: inside;
            padding-left: 5px;
            margin-bottom: 20px;
        }

        .info-card li {
            margin-bottom: 10px;
        }

        .info-card p {
            margin-bottom: 15px;
        }

        .info-card .tip {
            font-weight: 500;
        }

        /* Variações de Cor dos Cards */
        .card-light-blue {
            background-color: #f1f7ff;
        }

        .card-dark-blue {
            background-color: #3498DB;
            color: #fff;
        }

        .card-dark-blue h3,
        .card-dark-blue h4 {
            color: #fff;
        }

        /* Tabela no card central */
        .budget-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .budget-table th,
        .budget-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .budget-table tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .budget-table tr:last-child {
            border-bottom: none;
        }

        /* --- Rodapé --- */
        .page-footer {
            margin-top: 40px;
            font-size: 0.8rem;
            color: #adb5bd;
        }

        /* --- Responsividade --- */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .tabs-nav {
                overflow-x: auto;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="page-container">
        <header class="page-header">
            <a href="{{ route('dashboard') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <h1>Dicas Financeiras</h1>
        </header>

        <nav class="tabs-nav">
            <ul>
                <li><a href="#" class="active"><i class="fa-solid fa-dollar-sign"></i> <span>Orçamento</span></a></li>
                <li><a href="#"><i class="fa-solid fa-crosshairs"></i> <span>Metas</span></a></li>
                <li><a href="#"><i class="fa-solid fa-cart-shopping"></i> <span>Consumo</span></a></li>
                <li><a href="#"><i class="fa-solid fa-chart-line"></i> <span>Investir</span></a></li>
            </ul>
        </nav>

        <main class="content-grid">
            <article class="info-card card-light-blue">
                <h3>Poupança: Primeiro passo para o futuro.</h3>
                <h4>Por que guardar?</h4>
                <p>Poupança não é só guardar dinheiro. É criar liberdade pra escolher mais tarde:</p>
                <ul>
                    <li>Fazer um curso técnico</li>
                    <li>Pagar uma faculdade</li>
                    <li>Comprar um celular novo sem se endividar</li>
                    <li>Ter um valor guardado pra emergências</li>
                </ul>

                <h4>Mas e se R$200 parecer pouco?</h4>
                <p>Não precisa guardar tudo. Mas e se você separar só R$20 por mês?<br>
                    Opção 2: Resgatar Todo o Valor de Uma Vez</p>
                <ul>
                    <li>Em 12 meses: você terá R$240</li>
                    <li>Em 3 anos: R$720 + juros da poupança</li>
                </ul>
                <p><strong>Se guardar R$50, em 3 anos: R$1.800.</strong></p>
                <p>E se conseguir guardar metade (R$100), em 3 anos: R$3.600.<br>
                    É o começo de algo grande.<br>
                    E os R$1000 no fim do ano?<br>
                    Essa grana maior pode:</p>
                <ul>
                    <li>Aumentar sua reserva</li>
                    <li>Ser usada pra comprar à vista com desconto</li>
                    <li>Render mais em investimentos seguros, como poupança ou CDB</li>
                </ul>
                <p class="tip"><strong>Dica:</strong> divida o valor em três partes: uma pra guardar, uma pra investir e
                    uma pra aproveitar com consciência.</p>
            </article>

            <article class="info-card card-dark-blue">
                <h3>Planejamento e Orçamento.</h3>
                <h4>O que é orçamento?</h4>
                <p>É uma lista simples de:</p>
                <ul>
                    <li>Quanto você recebe</li>
                    <li>Quanto você gasta</li>
                    <li>Quanto você pode guardar</li>
                </ul>
                <p>É como o controle de um jogo. Se você não sabe quantas "vidas" (dinheiro) tem, fica mais difícil
                    vencer.</p>

                <h4>Como montar o seu com R$200</h4>
                <p>Exemplo:</p>
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Alimentação/lanches</td>
                            <td>R$80</td>
                        </tr>
                        <tr>
                            <td>Internet/celular</td>
                            <td>R$30</td>
                        </tr>
                        <tr>
                            <td>Transporte</td>
                            <td>R$20</td>
                        </tr>
                        <tr>
                            <td>Lazer</td>
                            <td>R$30</td>
                        </tr>
                        <tr>
                            <td>Guardar</td>
                            <td>R$40</td>
                        </tr>
                    </tbody>
                </table>
                <p>Você pode adaptar conforme sua realidade. O importante é dar um nome pra cada parte do dinheiro.</p>
                <p>Use a regra 50-30-20 (adaptada)</p>
                <ul>
                    <li>50% para o que é essencial</li>
                    <li>30% para o que você quer</li>
                    <li>20% para o seu futuro (guardar/investir)</li>
                </ul>
                <p><strong>Com isso, você vive o presente sem esquecer do amanhã.</strong></p>
            </article>

            <article class="info-card card-light-blue">
                <h3>Consumo consciente: você precisa ou só quer?</h3>
                <h4>Perguntas antes de comprar:</h4>
                <ul>
                    <li>Eu preciso disso mesmo agora?</li>
                    <li>Tem uma versão mais barata?</li>
                    <li>Posso esperar pra juntar mais?</li>
                    <li>Se eu guardar esse valor, posso comprar à vista depois com desconto?</li>
                </ul>

                <h4>O tempo é o melhor desconto</h4>
                <ul>
                    <li>Comprar à vista geralmente sai mais barato</li>
                    <li>Parcelar significa "comprometer seu futuro"</li>
                    <li>Esperar 1 ou 2 meses pode te fazer comprar melhor e com mais liberdade</li>
                </ul>

                <h4>Redes sociais e pressão de consumo</h4>
                <p>Ver o tempo todo os outros mostrando o que compraram pode dar a sensação de que você está "atrasado".
                    Mas lembre:</p>
                <ul>
                    <li>A maioria só mostra o que quer que a gente veja</li>
                    <li>Você tem um plano. E isso vale mais que curtidas</li>
                    <li>Ter um celular novo pode não ser mais importante que pagar um curso ou realizar um sonho.</li>
                </ul>
            </article>
        </main>

        <footer class="page-footer">
            <p>Fonte: https://www.caixa.gov.br/educacao-financeira/jovens/Paginas/default.aspx</p>
        </footer>
    </div>

</body>

</html>