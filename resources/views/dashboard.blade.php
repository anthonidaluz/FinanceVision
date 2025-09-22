@extends('layouts.app')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="space-y-12">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Bem-vindo de volta, {{ Auth::user()->name }}!</h2>
            <p class="mt-1 text-lg text-gray-600">Aqui está o resumo financeiro para
                {{ \Carbon\Carbon::now()->translatedFormat('F') }}.</p>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-xl shadow-lg transform hover:-translate-y-1 transition-transform">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium opacity-90">Receitas (Mês)</p>
                        <i class="fa-solid fa-arrow-up opacity-70"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">R$ {{ number_format($totalReceitasMes ?? 0, 2, ',', '.') }}</p>
                </div>
                <div
                    class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-xl shadow-lg transform hover:-translate-y-1 transition-transform">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium opacity-90">Despesas (Mês)</p>
                        <i class="fa-solid fa-arrow-down opacity-70"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">R$ {{ number_format($totalDespesasMes ?? 0, 2, ',', '.') }}</p>
                </div>
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow-lg transform hover:-translate-y-1 transition-transform">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium opacity-90">Saldo do Mês</p>
                        <i class="fa-solid fa-scale-balanced opacity-70"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">R$
                        {{ number_format(($totalReceitasMes ?? 0) - ($totalDespesasMes ?? 0), 2, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- SEÇÃO 2: ACESSO RÁPIDO (RESTAURADA) --}}
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Acesso Rápido</h3>
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

        {{-- SEÇÃO 3: ANÁLISES VISUAIS (GRÁFICOS) --}}
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Análises Visuais</h3>
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-md">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Evolução Financeira</h4>
                    <div class="h-80 bg-gray-50 flex items-center justify-center rounded-md border">
                        <div class="text-center text-gray-400">
                            <i class="fa-solid fa-chart-line text-6xl"></i>
                            <p class="mt-2 font-medium">Gráfico de Linhas (Em Breve)</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Despesas por Categoria</h4>
                    <div class="h-80 flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <i class="fa-solid fa-chart-pie text-6xl"></i>
                            <p class="mt-2 font-medium">Gráfico de Pizza (Em Breve)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEÇÃO 4: ACOMPANHAMENTO E GAMIFICAÇÃO (RESTAURADA E APRIMORADA) --}}
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
                                    <span class="text-sm font-semibold text-gray-800">R$
                                        {{ number_format($meta->current_amount, 2, ',', '.') }} / R$
                                        {{ number_format($meta->target_amount, 2, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ $meta->progress }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">
                                <i class="fa-solid fa-bullseye text-4xl text-gray-300 mb-2"></i>
                                <p>Nenhuma meta em andamento. <a href="{{ route('metas.create') }}"
                                        class="text-primary font-semibold hover:underline">Crie uma agora!</a></p>
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
                        <li class="flex items-start gap-3 opacity-50">
                            <div
                                class="flex-shrink-0 mt-1 h-8 w-8 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                <i class="fa-solid fa-trophy"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Conquista: Mestre da Poupança!</p>
                                <p class="text-xs text-gray-500">Funcionalidade em breve</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 opacity-50">
                            <div
                                class="flex-shrink-0 mt-1 h-8 w-8 rounded-full bg-green-100 text-success flex items-center justify-center">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Meta concluída!</p>
                                <p class="text-xs text-gray-500">Funcionalidade em breve</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 opacity-50">
                            <div
                                class="flex-shrink-0 mt-1 h-8 w-8 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Novo lançamento adicionado</p>
                                <p class="text-xs text-gray-500">Funcionalidade em breve</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection