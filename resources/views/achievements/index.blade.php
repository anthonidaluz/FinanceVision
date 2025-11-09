@extends('layouts.app')

@section('header')
    Minhas Conquistas
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <!-- Cabeçalho -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight animate__animated animate__fadeInDown">
                🏆 Hall da Fama
            </h2>
            <p class="mt-3 text-lg text-gray-500 max-w-2xl mx-auto">
                Seu progresso e disciplina financeira reconhecidos.
            </p>
        </div>

        <!-- Filtro por tema -->
        <div class="flex justify-center gap-3 mb-8 flex-wrap animate__animated animate__fadeIn">
            <button data-filter="all"
                class="filter-btn px-5 py-2.5 rounded-xl font-bold text-xs shadow transition bg-blue-600 text-white scale-105 border-none ring-2 ring-blue-100 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                <i class="fa-solid fa-star text-blue-300"></i> Todas
            </button>
            <button data-filter="bronze"
                class="filter-btn px-5 py-2.5 rounded-xl font-bold text-xs shadow transition bg-gray-100 text-gray-700 hover:bg-orange-100 hover:text-orange-700 ring-1 ring-orange-100 focus:ring-4 focus:ring-orange-300 focus:outline-none">
                <i class="fa-solid fa-medal text-orange-400"></i> Bronze
            </button>
            <button data-filter="prata"
                class="filter-btn px-5 py-2.5 rounded-xl font-bold text-xs shadow transition bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-700 ring-1 ring-gray-100 focus:ring-4 focus:ring-gray-300 focus:outline-none">
                <i class="fa-solid fa-medal text-gray-400"></i> Prata
            </button>
            <button data-filter="ouro"
                class="filter-btn px-5 py-2.5 rounded-xl font-bold text-xs shadow transition bg-gray-100 text-gray-700 hover:bg-yellow-100 hover:text-yellow-700 ring-1 ring-yellow-100 focus:ring-4 focus:ring-yellow-300 focus:outline-none">
                <i class="fa-solid fa-trophy text-yellow-400"></i> Ouro
            </button>
        </div>

        @if($achievements->isEmpty())
            <div
                class="bg-white text-center p-12 rounded-xl shadow-sm border border-gray-200 animate__animated animate__fadeInUp">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                    <i class="fa-solid fa-box-open text-3xl"></i>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-800">Sua jornada está apenas começando!</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Continue usando o Finance Vision para desbloquear suas primeiras conquistas.
                </p>
            </div>
        @else
            <div id="achievements-container"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 animate__animated animate__fadeInUp">
                @foreach ($achievements as $achievement)
                    @php
                        $themeClasses = match ($achievement->theme) {
                            'prata' => [
                                'border' => 'hover:border-gray-400 ring-2 ring-gray-200',
                                'points_bg' => 'bg-gray-400',
                                'icon_bg' => 'bg-gray-100',
                                'icon_text' => 'text-gray-500',
                            ],
                            'ouro' => [
                                'border' => 'hover:border-yellow-400 ring-2 ring-yellow-200',
                                'points_bg' => 'bg-yellow-400',
                                'icon_bg' => 'bg-yellow-100',
                                'icon_text' => 'text-yellow-500',
                            ],
                            default => [
                                'border' => 'hover:border-orange-400 ring-2 ring-orange-200',
                                'points_bg' => 'bg-orange-400',
                                'icon_bg' => 'bg-orange-100',
                                'icon_text' => 'text-orange-500',
                            ],
                        };
                    @endphp

                    <div data-theme="{{ $achievement->theme }}"
                        class="achievement-card relative bg-white rounded-3xl shadow-lg border border-gray-100 p-7 transition-all hover:shadow-2xl hover:-translate-y-1 {{ $themeClasses['border'] }}">
                        <div
                            class="absolute top-5 right-5 {{ $themeClasses['points_bg'] }} text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                            +{{ $achievement->points }} pts
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="flex-shrink-0 flex flex-col items-center">
                                <div
                                    class="h-14 w-14 flex items-center justify-center rounded-full shadow-sm {{ $themeClasses['icon_bg'] }} {{ $themeClasses['icon_text'] }}">
                                    <i class="{{ $achievement->icon }} text-3xl"></i>
                                </div>
                                <span class="mt-2 px-2 py-1 rounded font-bold text-xs shadow-sm
                                            {{ $achievement->theme === 'bronze' ? 'bg-orange-100 text-orange-700' :
                        ($achievement->theme === 'prata' ? 'bg-gray-100 text-gray-700' :
                            'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($achievement->theme) }}
                                </span>
                            </div>
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

    {{-- Filtro interativo --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterButtons = document.querySelectorAll(".filter-btn");
            const cards = document.querySelectorAll(".achievement-card");

            filterButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const filter = button.dataset.filter;

                    filterButtons.forEach(btn => btn.classList.remove("bg-blue-600", "text-white", "scale-105"));
                    button.classList.add("bg-blue-600", "text-white", "scale-105");

                    cards.forEach(card => {
                        const theme = card.dataset.theme;
                        if (filter === "all" || theme === filter) {
                            card.classList.remove("hidden", "animate__fadeOut");
                            card.classList.add("animate__fadeIn");
                        } else {
                            card.classList.remove("animate__fadeIn");
                            card.classList.add("animate__fadeOut");
                            setTimeout(() => card.classList.add("hidden"), 300);
                        }
                    });
                });
            });
        });
    </script>
@endsection