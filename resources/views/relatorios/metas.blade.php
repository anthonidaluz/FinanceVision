@extends('layouts.app')

@section('header')
    Relatório: Progresso de Metas
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-3xl shadow-xl border border-gray-100 space-y-10">

    <a href="{{ route('relatorios.index') }}"
        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
    </a>

    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900">🎯 Progresso de Metas</h2>
        <p class="text-gray-600 mt-2">Período: <strong>{{ $inicio }}</strong> até <strong>{{ $fim }}</strong></p>
    </div>

    @if(empty($dados))
        <div class="text-center text-gray-500 py-12">
            Nenhuma meta encontrada para este período.
        </div>
    @else
        <div class="space-y-6">
            @foreach($dados as $meta)
                @php
                    $progresso = $meta['progresso'];
                    $recebido = $meta['recebido'] ?? 0;
                    $prazo = $meta['prazo'] ?? null;

                    $status = $progresso >= 100 ? 'concluida' : ($prazo && now()->gt($prazo) ? 'atrasada' : 'andamento');
                    $statusIcon = $status === 'concluida' ? '✅' : ($status === 'atrasada' ? '🔴' : '⏳');
                    $statusColor = $status === 'concluida' ? 'text-green-700' : ($status === 'atrasada' ? 'text-red-600' : 'text-blue-600');
                    $barColor = $status === 'concluida' ? 'bg-green-500' : ($status === 'atrasada' ? 'bg-red-500' : 'bg-blue-500');
                @endphp

                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 flex items-center justify-center rounded-full bg-gray-200 text-lg">
                                {{ $statusIcon }}
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $meta['titulo'] }}</h3>
                        </div>
                        <span class="text-sm text-gray-500">Meta: R$ {{ number_format($meta['valor'], 2, ',', '.') }}</span>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="{{ $barColor }} h-4 rounded-full transition-all duration-500"
                            style="width: {{ $progresso }}%"></div>
                    </div>

                    <div class="mt-3 grid grid-cols-2 gap-4 text-sm">
                        <div class="flex flex-col">
                            <span class="text-gray-500">Recebido no período</span>
                            <span class="font-semibold text-gray-800">R$ {{ number_format($recebido, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-500">Progresso</span>
                            <span class="font-semibold {{ $statusColor }}">{{ $progresso }}%</span>
                        </div>
                    </div>

                    <div class="mt-3 text-sm {{ $statusColor }}">
                        {{ $statusIcon }} {{ ucfirst($status) }}
                        @if($prazo)
                            <span class="text-gray-500 ml-2">Prazo: {{ \Carbon\Carbon::parse($prazo)->format('d/m/Y') }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection