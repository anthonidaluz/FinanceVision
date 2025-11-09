@extends('layouts.app')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="space-y-12">

        {{-- SEÇÃO 1: KPIs E FILTRO --}}
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Bem-vindo de volta, {{ Auth::user()->name }}!</h2>
            <p class="mt-1 text-lg text-gray-600">
                Aqui está o resumo financeiro para {{ \Carbon\Carbon::now()->translatedFormat('F') }}.
            </p>

            {{-- Filtro visual --}}
            <div class="mb-8 flex items-center gap-3">
                <label for="periodo" class="text-sm text-gray-700 font-medium">Exibir:</label>
                <select id="periodo" name="periodo"
                    class="rounded-lg border-gray-300 text-sm focus:ring-[#3498db] focus:border-[#3498db] py-2 px-4 bg-white shadow-sm">
                    <option value="7d" {{ ($period ?? '28d') == '7d' ? 'selected' : '' }}>Últimos 7 dias</option>
                    <option value="28d" {{ ($period ?? '28d') == '28d' ? 'selected' : '' }}>Últimos 28 dias</option>
                    <option value="month" {{ ($period ?? '28d') == 'month' ? 'selected' : '' }}>Este mês</option>
                    <option value="year" {{ ($period ?? '28d') == 'year' ? 'selected' : '' }}>Este ano</option>
                    <option value="custom" {{ ($period ?? '28d') == 'custom' ? 'selected' : '' }}>Personalizado</option>
                </select>
                <div id="custom-range" class="flex items-center gap-1 ml-2"
                    style="display: {{ ($period ?? '28d') == 'custom' ? 'flex' : 'none' }};">
                    <input type="date" name="start_date" value="{{ $start_date ? $start_date->format('Y-m-d') : '' }}"
                        class="rounded border-gray-300 text-sm focus:border-[#3498db]" placeholder="Data início">
                    <span class="mx-1 text-gray-400">—</span>
                    <input type="date" name="end_date" value="{{ $end_date ? $end_date->format('Y-m-d') : '' }}"
                        class="rounded border-gray-300 text-sm focus:border-[#3498db]" placeholder="Data fim">
                </div>
            </div>
            <script>
                document.getElementById('periodo').addEventListener('change', function () {
                    document.getElementById('custom-range').style.display = (this.value === 'custom') ? 'flex' : 'none';
                });
            </script>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium opacity-90">Receitas</p>
                        <i class="fa-solid fa-arrow-up opacity-70"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2" id="kpi-receitas">R$
                        {{ number_format($totalReceitasMes ?? 0, 2, ',', '.') }}
                    </p>
                </div>
                <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium opacity-90">Despesas</p>
                        <i class="fa-solid fa-arrow-down opacity-70"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2" id="kpi-despesas">R$
                        {{ number_format($totalDespesasMes ?? 0, 2, ',', '.') }}
                    </p>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium opacity-90">Saldo Total</p>
                        <i class="fa-solid fa-scale-balanced opacity-70"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2" id="kpi-saldo">R$ {{ number_format($saldoAtual ?? 0, 2, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- SEÇÃO 2: AÇÕES RÁPIDAS --}}
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Ações Rápidas</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <a href="{{ route('lancamentos.index') }}"
                    class="bg-white p-6 rounded-xl shadow-md flex items-center gap-4 transition-all hover:shadow-lg hover:bg-gray-50">
                    <div
                        class="flex-shrink-0 inline-flex items-center justify-center h-12 w-12 rounded-lg bg-primary text-white">
                        <i class="fa-solid fa-plus fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Adicionar Lançamento</h4>
                        <p class="text-sm text-gray-600">Registre uma nova receita ou despesa.</p>
                    </div>
                </a>
                <a href="{{ route('metas.create') }}"
                    class="bg-white p-6 rounded-xl shadow-md flex items-center gap-4 transition-all hover:shadow-lg hover:bg-gray-50">
                    <div
                        class="flex-shrink-0 inline-flex items-center justify-center h-12 w-12 rounded-lg bg-yellow-400 text-white">
                        <i class="fa-solid fa-bullseye fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Criar Nova Meta</h4>
                        <p class="text-sm text-gray-600">Comece a planejar seu próximo objetivo.</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- SEÇÃO 3: GRÁFICOS --}}
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Análises Visuais</h3>
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-md">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Evolução Financeira</h4>
                    <div class="h-80"><canvas id="evolutionChart"></canvas></div>
                </div>
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Despesas por Categoria</h4>
                    <div class="h-80">
                        @if (count(json_decode($categoryLabels, true)) > 0)
                            <canvas id="categoryChart"></canvas>
                        @else
                            <div class="h-full flex flex-col items-center justify-center text-center text-gray-400">
                                <i class="fa-solid fa-chart-pie text-6xl"></i>
                                <p class="mt-2 font-medium">Sem despesas categorizadas no período.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- SEÇÃO 4: ACOMPANHAMENTO --}}
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Acompanhamento</h3>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Suas Metas em Destaque</h4>
                    <div class="space-y-4">
                        @forelse ($metasEmAndamento as $meta)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">{{ $meta->name }}</span>
                                    <span class="text-sm font-semibold text-gray-800">
                                        R$ {{ number_format($meta->current_amount, 2, ',', '.') }} /
                                        R$ {{ number_format($meta->target_amount, 2, ',', '.') }}
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ $meta->progress }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">
                                <i class="fa-solid fa-bullseye text-4xl text-gray-300 mb-2"></i>
                                <p>Nenhuma meta em andamento.
                                    <a href="{{ route('metas.create') }}"
                                        class="text-primary font-semibold hover:underline">Crie uma agora!</a>
                                </p>
                            </div>
                        @endforelse
                        <div class="text-right mt-4">
                            <a href="{{ route('metas.index') }}"
                                class="text-sm font-semibold text-primary hover:underline">Ver todas as metas →</a>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Atividade Recente</h4>
                    <ul class="space-y-4">
                        @forelse ($recentAchievements as $achievement)
                            <li class="flex items-start gap-3">
                                <div
                                    class="flex-shrink-0 mt-1 h-8 w-8 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                    <i class="{{ $achievement->icon }}"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $achievement->name }}</p>
                                    <p class="text-xs text-gray-500">Desbloqueado
                                        {{ $achievement->pivot->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="text-center text-sm text-gray-500 py-4">
                                Nenhuma conquista desbloqueada ainda. Continue registrando!
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let evolutionChart, categoryChart;
        document.addEventListener('DOMContentLoaded', function () {
            const filtro = document.getElementById('periodo');
            const startInput = document.querySelector('[name="start_date"]');
            const endInput = document.querySelector('[name="end_date"]');
            const receitasKPI = document.getElementById('kpi-receitas');
            const despesasKPI = document.getElementById('kpi-despesas');
            const saldoKPI = document.getElementById('kpi-saldo');

            // Gráfico Evolução Financeira (Linha) - Melhorado
            const evolutionCanvas = document.getElementById('evolutionChart');
            if (evolutionCanvas) {
                const evolutionLabels = {!! $evolutionLabels !!};
                const evolutionReceitas = {!! $evolutionReceitas !!};
                const evolutionDespesas = {!! $evolutionDespesas !!};
                const ctx = evolutionCanvas.getContext('2d');
                // Gradientes suaves e profissionais
                const gradientReceitas = ctx.createLinearGradient(0, 0, 0, 320);
                gradientReceitas.addColorStop(0, 'rgba(34,197,94,0.45)');
                gradientReceitas.addColorStop(1, 'rgba(34,197,94,0.04)');
                const gradientDespesas = ctx.createLinearGradient(0, 0, 0, 320);
                gradientDespesas.addColorStop(0, 'rgba(239,68,68,0.45)');
                gradientDespesas.addColorStop(1, 'rgba(239,68,68,0.04)');

                evolutionChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: evolutionLabels,
                        datasets: [
                            {
                                label: 'Receitas',
                                data: evolutionReceitas,
                                borderColor: '#22c55e',
                                backgroundColor: gradientReceitas,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#22c55e',
                                pointBorderColor: '#fff',
                                pointRadius: 5,
                                pointHoverRadius: 7,
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: '#22c55e'
                            },
                            {
                                label: 'Despesas',
                                data: evolutionDespesas,
                                borderColor: '#ef4444',
                                backgroundColor: gradientDespesas,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#ef4444',
                                pointBorderColor: '#fff',
                                pointRadius: 5,
                                pointHoverRadius: 7,
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: '#ef4444'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: { font: { family: "'Inter', sans-serif", size: 14 }, color: '#1f2937' }
                            },
                            tooltip: {
                                backgroundColor: '#111827',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: '#22c55e',
                                borderWidth: 1,
                                padding: 14,
                                callbacks: {
                                    label: context => {
                                        const value = context.raw;
                                        return `${context.dataset.label}: R$ ${Number(value).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#4B5563',
                                    font: { family: "'Inter', sans-serif", size: 12 },
                                    callback: value => `R$ ${value.toLocaleString('pt-BR')}`
                                },
                                grid: { color: 'rgba(0,0,0,0.04)' }
                            },
                            x: {
                                ticks: {
                                    color: '#4B5563',
                                    font: { family: "'Inter', sans-serif", size: 12 }
                                },
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            // Gráfico de Categorias (Pizza) - Melhorado
            const categoryCanvas = document.getElementById('categoryChart');
            if (categoryCanvas) {
                const categoryLabels = {!! $categoryLabels !!};
                const categoryTotals = {!! $categoryTotals !!};
                categoryChart = new Chart(categoryCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            data: categoryTotals,
                            backgroundColor: [
                                '#3498db', // Azul principal
                                '#ef4444', // Vermelho
                                '#22c55e', // Verde
                                '#f59e0b', // Amarelo/dourado
                                '#a3e635', // Verde claro
                                '#6366f1', // Roxo/azul
                                '#eab308', // Amarelo extra
                                '#14b8a6', // Turquesa
                                '#f472b6', // Rosa
                            ],
                            borderColor: '#fff',
                            borderWidth: 2,
                            hoverOffset: 14,
                            borderRadius: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    font: { family: "'Inter', sans-serif", size: 13 },
                                    color: '#1f2937',
                                    padding: 18,
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                backgroundColor: '#0ea5e9',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                callbacks: {
                                    label: function (context) {
                                        let label = context.label || '';
                                        let value = context.raw;
                                        return ` ${label}: R$ ${Number(value).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
                                    }
                                }
                            }
                        },
                        cutout: '68%',
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            }


            function fetchData() {
                const periodo = filtro.value;
                const start_date = startInput ? startInput.value : '';
                const end_date = endInput ? endInput.value : '';
                let url = "{{ route('dashboard.data') }}?periodo=" + encodeURIComponent(periodo);
                if (periodo === 'custom') {
                    url += '&start_date=' + encodeURIComponent(start_date) + '&end_date=' + encodeURIComponent(end_date);
                }
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        receitasKPI.textContent = "R$ " + parseFloat(data.totalReceitas).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                        despesasKPI.textContent = "R$ " + parseFloat(data.totalDespesas).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                        saldoKPI.textContent = "R$ " + parseFloat(data.saldoAtual).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                        if (evolutionChart && data.evolutionLabels && data.evolutionReceitas && data.evolutionDespesas) {
                            evolutionChart.data.labels = data.evolutionLabels;
                            evolutionChart.data.datasets[0].data = data.evolutionReceitas;
                            evolutionChart.data.datasets[1].data = data.evolutionDespesas;
                            evolutionChart.update();
                        }
                        if (categoryChart && data.categoryLabels && data.categoryTotals) {
                            categoryChart.data.labels = data.categoryLabels;
                            categoryChart.data.datasets[0].data = data.categoryTotals;
                            categoryChart.update();
                        }
                    });
            }
            filtro.addEventListener('change', fetchData);
            if (startInput && endInput) {
                startInput.addEventListener('change', fetchData);
                endInput.addEventListener('change', fetchData);
            }
        });
    </script>
@endsection