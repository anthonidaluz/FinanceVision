@extends('layouts.app')

@section('header')
    Relatórios Financeiros
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Cabeçalho da Página --}}
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">📊 Central de Relatórios</h2>
            <p class="mt-3 text-lg text-gray-500 max-w-2xl mx-auto">
                Visualize seus dados de forma clara, identifique padrões e tome decisões estratégicas.
            </p>
        </div>

        {{-- Filtros Principais --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 mb-10">
            <form class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-end">
                <div>
                    <label for="report_type" class="block text-sm font-semibold text-gray-700">Tipo de Relatório</label>
                    <select id="report_type" name="report_type"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
                        <option>Despesas por Categoria</option>
                        <option disabled>Fluxo de Caixa (em breve)</option>
                        <option disabled>Evolução Patrimonial (em breve)</option>
                    </select>
                </div>

                <div>
                    <label for="period" class="block text-sm font-semibold text-gray-700">Período</label>
                    <select id="period" name="period"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
                        <option>Este Mês</option>
                        <option>Mês Passado</option>
                        <option>Este Ano</option>
                        <option>Período Personalizado</option>
                    </select>
                </div>

                <div class="flex">
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 rounded-lg shadow-md text-sm font-semibold text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        <i class="fa-solid fa-filter mr-2"></i>
                        Gerar Relatório
                    </button>
                </div>
            </form>
        </div>

        {{-- Outros Relatórios (Cards) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center gap-4">
                    <div
                        class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-xl bg-green-100 text-green-600">
                        <i class="fa-solid fa-money-bill-trend-up fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Fluxo de Caixa Mensal</h3>
                        <p class="text-sm text-gray-500">Compare receitas e despesas ao longo do tempo.</p>
                    </div>
                </div>
                <button disabled
                    class="mt-5 w-full py-2 rounded-lg text-sm font-semibold text-gray-400 bg-gray-100 cursor-not-allowed">
                    Em Breve
                </button>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center gap-4">
                    <div
                        class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-xl bg-yellow-100 text-yellow-600">
                        <i class="fa-solid fa-bullseye fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Progresso de Metas</h3>
                        <p class="text-sm text-gray-500">Acompanhe a evolução das suas metas financeiras.</p>
                    </div>
                </div>
                <button disabled
                    class="mt-5 w-full py-2 rounded-lg text-sm font-semibold text-gray-400 bg-gray-100 cursor-not-allowed">
                    Em Breve
                </button>
            </div>
        </div>

        {{-- Relatório Principal --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex flex-col lg:flex-row items-center gap-10">
                <div class="w-full lg:w-1/3">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Despesas por Categoria <span
                            class="text-gray-400">(Set/2025)</span></h3>
                    {{-- Placeholder para o gráfico --}}
                    <div
                        class="relative h-64 flex items-center justify-center border-2 border-dashed border-gray-200 rounded-lg">
                        <div class="text-center text-gray-400">
                            <i class="fa-solid fa-chart-pie text-6xl"></i>
                            <p class="mt-2 text-sm">Gráfico será exibido aqui</p>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:flex-1">
                    <ul class="divide-y divide-gray-100">
                        @forelse ($despesasPorCategoria ?? [] as $categoria => $total)
                            <li class="flex justify-between items-center py-3 text-sm">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 rounded-full bg-primary mr-3"></span>
                                    <span class="text-gray-700">{{ $categoria }}</span>
                                </div>
                                <span class="font-semibold text-gray-900">R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </li>
                        @empty
                            <li class="text-center text-gray-500 py-6">Nenhuma despesa encontrada para o período selecionado.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection