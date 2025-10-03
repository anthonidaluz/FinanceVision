@extends('layouts.app')

@section('header')
    Relatórios Financeiros
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        {{-- Cabeçalho da Página --}}
        <div class="text-center">
            <h2 class="text-4xl font-bold text-gray-900 tracking-tight">📊 Central de Relatórios</h2>
            <p class="mt-3 text-lg text-gray-500 max-w-2xl mx-auto">
                Visualize seus dados com clareza, identifique padrões e tome decisões estratégicas.
            </p>
        </div>

        {{-- Filtros Principais --}}
        <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
            <form action="{{ route('relatorios.gerar') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-8 items-end">

                {{-- Tipo de Relatório --}}
                <div>
                    <label for="report_type" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de
                        Relatório</label>
                    <select id="report_type" name="report_type"
                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-primary focus:border-primary text-sm">
                        <option value="fluxo">📈 Fluxo de Caixa</option>
                        <option value="metas">🎯 Progresso de Metas</option>
                    </select>
                </div>

                {{-- Data de Início --}}
                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Data Inicial</label>
                    <input type="date" id="start_date" name="start_date"
                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-primary focus:border-primary text-sm">
                </div>

                {{-- Data de Fim --}}
                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Data Final</label>
                    <input type="date" id="end_date" name="end_date"
                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-primary focus:border-primary text-sm">
                </div>

                {{-- Botão --}}
                <div class="flex">
                    <button type="submit"
                        class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 rounded-xl shadow-md text-sm font-semibold text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        <i class="fa-solid fa-chart-line mr-2"></i> Gerar Relatório
                    </button>
                </div>
            </form>
        </div>

        {{-- Sugestões de Relatórios (Cards) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 flex items-center justify-center rounded-xl bg-green-100 text-green-600">
                        <i class="fa-solid fa-money-bill-trend-up fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Fluxo de Caixa</h3>
                        <p class="text-sm text-gray-500">Compare receitas e despesas ao longo do tempo.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 flex items-center justify-center rounded-xl bg-yellow-100 text-yellow-600">
                        <i class="fa-solid fa-bullseye fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Progresso de Metas</h3>
                        <p class="text-sm text-gray-500">Acompanhe a evolução das suas metas financeiras.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection