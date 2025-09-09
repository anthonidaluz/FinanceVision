@extends('layouts.app')

@section('header')
    Relatórios Financeiros
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">
        {{-- Cabeçalho da Página --}}
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-gray-800">Central de Relatórios</h2>
            <p class="mt-2 text-lg text-gray-600">Analise seus dados, identifique padrões e tome decisões mais inteligentes.
            </p>
        </div>

        {{-- Filtros Principais --}}
        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="w-full sm:w-1/3">
                    <label for="report_type" class="block text-sm font-medium text-gray-700">Tipo de Relatório</label>
                    <select id="report_type" name="report_type"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                        <option>Despesas por Categoria</option>
                        <option disabled>Fluxo de Caixa (em breve)</option>
                        <option disabled>Evolução Patrimonial (em breve)</option>
                    </select>
                </div>
                <div class="w-full sm:w-1/3">
                    <label for="period" class="block text-sm font-medium text-gray-700">Período</label>
                    <select id="period" name="period"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                        <option>Este Mês</option>
                        <option>Mês Passado</option>
                        <option>Este Ano</option>
                        <option>Período Personalizado</option>
                    </select>
                </div>
                <div class="w-full sm:w-auto mt-4 sm:mt-0 sm:self-end">
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <i class="fa-solid fa-filter mr-2"></i>
                        Gerar
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 mb-8">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <div class="w-full lg:w-1/3">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Despesas por Categoria (Set/2025)</h3>
                    {{-- Placeholder para o gráfico dinâmico --}}
                    <div class="relative h-64 flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <i class="fa-solid fa-chart-pie text-6xl text-gray-200"></i>
                            <p class="mt-2">Gráfico virá aqui</p>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex-1">
                    <ul class="space-y-4">
                        @forelse ($despesasPorCategoria ?? [] as $categoria => $total)
                            <li class="flex justify-between items-center text-sm">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 rounded-full bg-primary mr-3"></span>
                                    <span class="text-gray-600">{{ $categoria }}</span>
                                </div>
                                <span class="font-semibold text-gray-800">R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </li>
                        @empty
                            <li class="text-center text-gray-500 py-4">Nenhuma despesa para exibir no período selecionado.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Outros Relatórios (Placeholders) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 border">
                <div class="flex items-center gap-4">
                    <div
                        class="flex-shrink-0 inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-100 text-success">
                        <i class="fa-solid fa-money-bill-trend-up fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Fluxo de Caixa Mensal</h3>
                        <p class="text-sm text-gray-500">Compare suas receitas e despesas ao longo do tempo.</p>
                    </div>
                </div>
                <button disabled class="mt-4 w-full text-sm font-semibold text-gray-400 cursor-not-allowed">Em
                    Breve</button>
            </div>
            <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 border">
                <div class="flex items-center gap-4">
                    <div
                        class="flex-shrink-0 inline-flex items-center justify-center h-12 w-12 rounded-lg bg-yellow-100 text-yellow-600">
                        <i class="fa-solid fa-bullseye fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Progresso de Metas</h3>
                        <p class="text-sm text-gray-500">Acompanhe a evolução das suas metas de poupança.</p>
                    </div>
                </div>
                <button disabled class="mt-4 w-full text-sm font-semibold text-gray-400 cursor-not-allowed">Em
                    Breve</button>
            </div>
        </div>
    </div>
@endsection