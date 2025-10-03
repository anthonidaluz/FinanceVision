@extends('layouts.app')

@section('header')
    Relatório: Fluxo de Caixa
@endsection

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-3xl shadow-xl border border-gray-100 space-y-10">
        <a href="{{ route('relatorios.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
        </a>

        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">📈 Fluxo de Caixa</h2>
            <p class="text-gray-600 mt-2">Período: <strong>{{ $inicio }}</strong> até <strong>{{ $fim }}</strong></p>
        </div>



        @if($receitas == 0 && $despesas == 0)
            <div class="text-center text-gray-500 py-12">
                Nenhum dado disponível para este período.
            </div>
        @else
            {{-- Cards empilhados verticalmente --}}
            <div class="space-y-6">
                <div class="bg-green-50 p-6 rounded-xl border border-green-200 shadow-sm">
                    <h3 class="text-sm font-semibold text-green-700 mb-1">Receitas</h3>
                    <p class="text-2xl font-bold text-green-600">R$ {{ number_format($receitas, 2, ',', '.') }}</p>
                </div>

                <div class="bg-red-50 p-6 rounded-xl border border-red-200 shadow-sm">
                    <h3 class="text-sm font-semibold text-red-700 mb-1">Despesas</h3>
                    <p class="text-2xl font-bold text-red-500">R$ {{ number_format($despesas, 2, ',', '.') }}</p>
                </div>

                <div class="bg-blue-50 p-6 rounded-xl border border-blue-200 shadow-sm">
                    <h3 class="text-sm font-semibold text-blue-700 mb-1">Saldo</h3>
                    <p class="text-2xl font-bold text-blue-600">R$ {{ number_format($saldo, 2, ',', '.') }}</p>
                </div>
            </div>

            {{-- Distribuição por categoria --}}
            <div class="mt-10 space-y-10">
                {{-- Receitas por categoria --}}
                <div>
                    <h4 class="text-lg font-semibold text-green-700 mb-4">💰 Categorias de Receita</h4>
                    <ul class="space-y-4 text-sm text-gray-700">
                        @php
                            $receitasPorCategoria = $lancamentos->where('type', 'receita')->groupBy(fn($l) => optional($l->category)->name ?? 'Sem Categoria');
                        @endphp
                        @forelse($receitasPorCategoria as $categoria => $items)
                            @php
                                $cat = $items->first()->category;
                                $total = $items->sum('amount');
                            @endphp
                            <li class="flex items-center justify-between border-b pb-3">
                                <div class="flex items-center gap-3">
                                    @if($cat && $cat->icon)
                                        <i class="{{ $cat->icon }} text-lg" style="color: {{ $cat->color ?? '#16a34a' }}"></i>
                                    @endif
                                    <span class="font-medium">{{ $categoria }}</span>
                                </div>
                                <span class="text-green-600 font-semibold">+ R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </li>
                        @empty
                            <li class="text-gray-500">Nenhuma receita registrada.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Despesas por categoria --}}
                <div>
                    <h4 class="text-lg font-semibold text-red-700 mb-4">🧾 Categorias de Despesa</h4>
                    <ul class="space-y-4 text-sm text-gray-700">
                        @php
                            $despesasPorCategoria = $lancamentos->where('type', 'despesa')->groupBy(fn($l) => optional($l->category)->name ?? 'Sem Categoria');
                        @endphp
                        @forelse($despesasPorCategoria as $categoria => $items)
                            @php
                                $cat = $items->first()->category;
                                $total = $items->sum('amount');
                            @endphp
                            <li class="flex items-center justify-between border-b pb-3">
                                <div class="flex items-center gap-3">
                                    @if($cat && $cat->icon)
                                        <i class="{{ $cat->icon }} text-lg" style="color: {{ $cat->color ?? '#dc2626' }}"></i>
                                    @endif
                                    <span class="font-medium">{{ $categoria }}</span>
                                </div>
                                <span class="text-red-500 font-semibold">− R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </li>
                        @empty
                            <li class="text-gray-500">Nenhuma despesa registrada.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection