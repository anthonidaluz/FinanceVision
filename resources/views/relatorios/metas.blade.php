@extends('layouts.app')

@section('header')
    Relatório: Progresso de Metas
@endsection

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-3xl shadow-2xl border border-gray-50 space-y-10">

        <a href="{{ route('relatorios.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
        </a>

        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-900">🎯 Progresso de Metas</h2>
            <p class="text-gray-600 mt-2 text-base">
                Período: <strong class="text-gray-800">{{ $inicio }}</strong> até <strong
                    class="text-gray-800">{{ $fim }}</strong>
            </p>
        </div>

        @if(empty($dados))
            <div class="text-center text-gray-500 py-16">
                <div class="flex justify-center mb-4">
                    <i class="fa-solid fa-road-barrier text-4xl text-gray-300"></i>
                </div>
                Nenhuma meta encontrada para este período.
            </div>
        @else
            <div class="space-y-8">
                @foreach($dados as $meta)
                    @php
                        $progresso = $meta['progresso'];
                        $recebido = $meta['recebido'] ?? 0;
                        $prazo = $meta['prazo'] ?? null;

                        $status = $progresso >= 100 ? 'concluida' : ($prazo && now()->gt($prazo) ? 'atrasada' : 'andamento');
                        $statusIcon = $status === 'concluida' ? '✅' : ($status === 'atrasada' ? '🔴' : '⏳');
                        $statusColor = $status === 'concluida' ? 'text-green-700' : ($status === 'atrasada' ? 'text-red-600' : 'text-blue-600');
                        $barColor = $status === 'concluida' ? 'bg-green-500' : ($status === 'atrasada' ? 'bg-red-500' : 'bg-blue-600');
                        $fadeBar = $status === 'concluida' ? 'bg-gradient-to-r from-green-400 to-green-600' :
                            ($status === 'atrasada' ? 'bg-gradient-to-r from-red-400 to-red-600' :
                                'bg-gradient-to-r from-blue-400 to-blue-600');
                    @endphp

                    <div
                        class="bg-gray-50 p-7 rounded-2xl border border-gray-100 shadow hover:shadow-lg transition-all group animate__animated animate__fadeInUp">
                        <div class="flex justify-between items-center mb-5">
                            <div class="flex items-center gap-3">
                                <span
                                    class="h-10 w-10 flex items-center justify-center rounded-full bg-gray-200 text-xl shadow">{{ $statusIcon }}</span>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $meta['titulo'] }}</h3>
                            </div>
                            <span class="text-sm text-gray-500">Meta: <span class="font-bold text-gray-700">R$
                                    {{ number_format($meta['valor'], 2, ',', '.') }}</span></span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-5 shadow-inner overflow-hidden relative">
                            <div class="{{ $fadeBar }} h-5 rounded-full transition-all duration-700"
                                style="width: {{ min(100, $progresso) }}%"></div>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold {{ $statusColor }}">
                                {{ $progresso }}%
                            </span>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-6 text-sm">
                            <div class="flex flex-col">
                                <span class="text-gray-500">Recebido no período</span>
                                <span class="font-semibold text-gray-900">R$ {{ number_format($recebido, 2, ',', '.') }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-gray-500">Status</span>
                                <span class="font-semibold {{ $statusColor }}">
                                    {{ $statusIcon }} {{ ucfirst($status) }}
                                    @if($prazo)
                                        <span class="text-xs text-gray-400 ml-1">
                                            (Prazo: {{ \Carbon\Carbon::parse($prazo)->format('d/m/Y') }})
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection