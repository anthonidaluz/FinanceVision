@extends('layouts.app')

@section('header')
    Minhas Conquistas
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">
        {{-- Cabeçalho da Página --}}
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">🏆 Hall da Fama</h2>
            <p class="mt-3 text-lg text-gray-500 max-w-2xl mx-auto">
                Seu progresso e disciplina financeira reconhecidos.
            </p>
        </div>

        @if($achievements->isEmpty())
            <div class="bg-white text-center p-12 rounded-xl shadow-sm border border-gray-200">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                    <i class="fa-solid fa-box-open text-3xl"></i>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-800">Sua jornada está apenas começando!</h3>
                <p class="mt-2 text-sm text-gray-500">Continue usando o Finance Vision para desbloquear suas primeiras
                    conquistas.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- ### CÓDIGO ATUALIZADO AQUI ### --}}
                @foreach ($achievements as $achievement)
                    @php
                        // Lógica para definir as classes de cor com base no tema da conquista
                        $themeClasses = match ($achievement->theme) {
                            'prata' => [
                                'border' => 'hover:border-gray-400',
                                'points_bg' => 'bg-gray-400',
                                'icon_bg' => 'bg-gray-100',
                                'icon_text' => 'text-gray-500',
                            ],
                            'ouro' => [
                                'border' => 'hover:border-yellow-400',
                                'points_bg' => 'bg-yellow-400',
                                'icon_bg' => 'bg-yellow-100',
                                'icon_text' => 'text-yellow-500',
                            ],
                            default => [ // bronze
                                'border' => 'hover:border-orange-400',
                                'points_bg' => 'bg-orange-400',
                                'icon_bg' => 'bg-orange-100',
                                'icon_text' => 'text-orange-500',
                            ],
                        };
                    @endphp

                    <div
                        class="relative bg-white rounded-2xl shadow-md border border-gray-100 p-6 transition-all hover:shadow-xl hover:-translate-y-1 {{ $themeClasses['border'] }}">
                        {{-- Pontos flutuantes --}}
                        <div
                            class="absolute top-4 right-4 {{ $themeClasses['points_bg'] }} text-white text-xs font-bold px-2 py-1 rounded-full shadow-sm">
                            +{{ $achievement->points }} pts
                        </div>

                        <div class="flex items-start gap-4">
                            {{-- Ícone --}}
                            <div
                                class="flex-shrink-0 h-14 w-14 flex items-center justify-center rounded-full shadow-sm {{ $themeClasses['icon_bg'] }} {{ $themeClasses['icon_text'] }}">
                                <i class="{{ $achievement->icon }} text-3xl"></i>
                            </div>

                            {{-- Conteúdo --}}
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900">{{ $achievement->name }}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $achievement->description }}</p>
                                <p class="mt-3 text-xs text-gray-400 font-medium flex items-center gap-1">
                                    <i class="fa-solid fa-calendar-check"></i>
                                    Desbloqueado em {{ $achievement->pivot->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection