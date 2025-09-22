@extends('layouts.app')

@section('header')
    Minhas Metas
@endsection

@section('content')
    {{-- Bloco para exibir mensagens de sucesso e erro --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- Filtros --}}
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <form action="{{ route('metas.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
            <div class="w-full sm:w-1/3">
                <label for="status" class="block text-sm font-medium text-gray-700">Filtrar por Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                    <option value="">Todos</option>
                    <option value="progress" @selected($selectedStatus == 'progress')>Em Progresso</option>
                    <option value="completed" @selected($selectedStatus == 'completed')>Concluídas</option>
                    <option value="overdue" @selected($selectedStatus == 'overdue')>Atrasadas</option>
                </select>
            </div>
            <div class="w-full sm:w-1/3">
                <label for="sort" class="block text-sm font-medium text-gray-700">Ordenar por</label>
                <select name="sort" id="sort"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                    <option value="newest" @selected($selectedSort == 'newest')>Mais Recentes</option>
                    <option value="closest_due_date" @selected($selectedSort == 'closest_due_date')>Prazo Final</option>
                </select>
            </div>
            <div class="w-full sm:w-auto mt-4 sm:mt-0 sm:self-end">
                <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Filtrar
                </button>
            </div>
        </form>
    </div>

    <main class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @forelse ($metas as $meta)
            @php
                $isCompleted = $meta->progress >= 100;
                $isOverdue = !$isCompleted && $meta->target_date && \Carbon\Carbon::parse($meta->target_date)->isPast();
                $borderColorClass = 'border-yellow-400';
                if ($isCompleted)
                    $borderColorClass = 'border-green-500';
                if ($isOverdue)
                    $borderColorClass = 'border-red-500';
            @endphp
            <article
                class="bg-white rounded-xl shadow-md border-t-4 {{ $borderColorClass }} p-6 flex flex-col sm:flex-row gap-6">
                <div class="flex-grow flex flex-col">
                    <div>
                        <p class="text-sm font-semibold text-gray-500">META {{ $loop->iteration }}</p>
                        <h3 class="text-xl font-bold text-gray-800 mt-1">{{ $meta->name }}</h3>
                        <div class="text-sm space-y-2 mt-4 text-gray-600">
                            <p>
                                <strong class="font-medium text-gray-700">Status:</strong>
                                <span
                                    class="font-semibold px-2 py-1 rounded-full text-xs
                                            {{ $isCompleted ? 'bg-green-100 text-green-800' : ($isOverdue ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $isCompleted ? 'Concluída' : ($isOverdue ? 'Atrasada' : 'Em Progresso') }}
                                </span>
                            </p>
                            <p><strong class="font-medium text-gray-700">Objetivo:</strong> R$
                                {{ number_format($meta->target_amount, 2, ',', '.') }}</p>
                            <p><strong class="font-medium text-gray-700">Poupado:</strong> R$
                                {{ number_format($meta->current_amount, 2, ',', '.') }}</p>
                            <p><strong class="font-medium text-gray-700">Prazo:</strong>
                                {{ $meta->target_date ? \Carbon\Carbon::parse($meta->target_date)->format('d/m/Y') : 'Sem prazo' }}
                            </p>
                        </div>
                    </div>

                    {{-- ÁREA DE AÇÕES ATUALIZADA --}}
                    <div class="flex items-center gap-2 mt-6 pt-4 border-t border-gray-200 mt-auto">
                        <a href="{{ route('metas.edit', $meta) }}"
                            class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90">Editar</a>

                        @if($meta->lancamentos_count > 0)
                            {{-- Botão desabilitado com dica --}}
                            <button type="button" disabled
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-400 uppercase tracking-widest cursor-not-allowed"
                                title="Esta meta não pode ser excluída pois está vinculada a {{ $meta->lancamentos_count }} lançamento(s).">
                                Excluir
                            </button>
                        @else
                            {{-- Formulário de exclusão funcional --}}
                            <form action="{{ route('metas.destroy', $meta) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                    Excluir
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="flex-shrink-0 flex flex-col items-center justify-center gap-2">
                    <div class="donut-chart w-32 h-32 rounded-full relative flex justify-center items-center"
                        style="--p: {{ $meta->progress }}; background: conic-gradient(var(--success, #28a745) 0% calc(var(--p) * 1%), var(--danger, #e74c3c) calc(var(--p) * 1%) 100%);">
                        <div class="w-[80%] h-[80%] bg-white rounded-full"></div>
                        <span class="absolute text-2xl font-bold text-gray-700">{{ round($meta->progress) }}%</span>
                    </div>
                    <div class="text-xs text-center text-gray-500">Progresso</div>
                </div>
            </article>
        @empty
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fa-solid fa-bullseye text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700">Nenhuma meta encontrada</h3>
                <p class="text-gray-500 mt-2">Que tal adicionar sua primeira meta usando o botão abaixo?</p>
            </div>
        @endforelse

        <a href="{{ route('metas.create') }}"
            class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center text-gray-500 hover:bg-gray-50 hover:border-primary hover:text-primary transition-all min-h-[200px] py-10">
            <i class="fa-solid fa-plus text-4xl"></i>
            <span class="mt-2 font-semibold">Adicionar nova meta</span>
        </a>
    </main>
@endsection