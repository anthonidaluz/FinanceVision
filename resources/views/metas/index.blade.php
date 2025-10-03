@extends('layouts.app')

@section('header')
    Minhas Metas
@endsection

@section('content')
    {{-- Feedback --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl shadow-sm mb-6">
            <i class="fa-solid fa-check-circle mr-2"></i> <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl shadow-sm mb-6">
            <i class="fa-solid fa-exclamation-circle mr-2"></i> <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Filtros --}}
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 mb-10">
        <form action="{{ route('metas.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-end">
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Filtrar por Status</label>
                <select name="status" id="status"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                    <option value="">Todos</option>
                    <option value="progress" @selected($selectedStatus == 'progress')>Em Progresso</option>
                    <option value="completed" @selected($selectedStatus == 'completed')>Concluídas</option>
                    <option value="overdue" @selected($selectedStatus == 'overdue')>Atrasadas</option>
                </select>
            </div>
            <div>
                <label for="sort" class="block text-sm font-semibold text-gray-700 mb-2">Ordenar por</label>
                <select name="sort" id="sort"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                    <option value="newest" @selected($selectedSort == 'newest')>Mais Recentes</option>
                    <option value="closest_due_date" @selected($selectedSort == 'closest_due_date')>Prazo Final</option>
                </select>
            </div>
            <div>
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition w-full sm:w-auto">
                    <i class="fa-solid fa-filter mr-2"></i> Filtrar
                </button>
            </div>
        </form>
    </div>

    {{-- Lista de Metas --}}
    <main class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @forelse ($metas as $meta)
            @php
                $isCompleted = $meta->progress >= 100;
                $isOverdue = !$isCompleted && $meta->target_date && \Carbon\Carbon::parse($meta->target_date)->isPast();
                $statusLabel = $isCompleted ? 'Concluída' : ($isOverdue ? 'Atrasada' : 'Em Progresso');
                $statusColor = $isCompleted ? 'green' : ($isOverdue ? 'red' : 'yellow');
                $borderColorClass = "border-{$statusColor}-500";
                $badgeClass = "bg-{$statusColor}-100 text-{$statusColor}-800";
            @endphp

            <article
                class="bg-white rounded-2xl shadow-md border-t-4 {{ $borderColorClass }} p-6 flex flex-col sm:flex-row gap-6">
                <div class="flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500">META {{ $loop->iteration }}</p>
                        <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $meta->name }}</h3>

                        <div class="text-sm space-y-2 mt-4 text-gray-600">
                            <p>
                                <strong class="text-gray-700">Status:</strong>
                                <span class="font-semibold px-2 py-1 rounded-full text-xs {{ $badgeClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </p>
                            <p><strong class="text-gray-700">Objetivo:</strong> R$
                                {{ number_format($meta->target_amount, 2, ',', '.') }}</p>
                            <p><strong class="text-gray-700">Poupado:</strong> R$
                                {{ number_format($meta->current_amount, 2, ',', '.') }}</p>
                            <p><strong class="text-gray-700">Prazo:</strong>
                                {{ $meta->target_date ? \Carbon\Carbon::parse($meta->target_date)->format('d/m/Y') : 'Sem prazo' }}
                            </p>
                        </div>
                    </div>

                    {{-- Ações --}}
                    <div class="flex items-center gap-3 mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('metas.edit', $meta) }}"
                            class="inline-flex items-center px-4 py-2 bg-primary text-white text-xs font-semibold rounded-md shadow-sm hover:bg-primary/90 transition">
                            <i class="fa-solid fa-pencil mr-2"></i> Editar
                        </a>

                        @if($meta->lancamentos_count > 0)
                            <button type="button" disabled
                                class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-400 text-xs font-semibold rounded-md cursor-not-allowed"
                                title="Esta meta está vinculada a {{ $meta->lancamentos_count }} lançamento(s)">
                                <i class="fa-solid fa-lock mr-2"></i> Excluir
                            </button>
                        @else
                            <form action="{{ route('metas.destroy', $meta) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-xs font-semibold rounded-md hover:bg-gray-50 transition">
                                    <i class="fa-solid fa-trash mr-2"></i> Excluir
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Gráfico de progresso --}}
                <div class="flex-shrink-0 flex flex-col items-center justify-center gap-2">
                    <div class="donut-chart w-32 h-32 rounded-full relative flex justify-center items-center"
                        style="--p: {{ $meta->progress }}; background: conic-gradient(var(--success, #28a745) 0% calc(var(--p) * 1%), var(--danger, #e74c3c) calc(var(--p) * 1%) 100%)">
                        <div class="w-[80%] h-[80%] bg-white rounded-full"></div>
                        <span class="absolute text-2xl font-bold text-gray-700">{{ round($meta->progress) }}%</span>
                    </div>
                    <div class="text-xs text-center text-gray-500">Progresso</div>
                </div>
            </article>
        @empty
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-12 text-center">
                <i class="fa-solid fa-bullseye text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700">Nenhuma meta encontrada</h3>
                <p class="text-gray-500 mt-2">Que tal adicionar sua primeira meta usando o botão abaixo?</p>
            </div>
        @endforelse

        {{-- Botão Adicionar Meta --}}
        <a href="{{ route('metas.create') }}"
            class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center text-gray-500 hover:bg-gray-50 hover:border-primary hover:text-primary transition-all min-h-[200px] py-10">
            <i class="fa-solid fa-plus text-4xl"></i>
            <span class="mt-2 font-semibold">Adicionar nova meta</span>
        </a>
    </main>
@endsection