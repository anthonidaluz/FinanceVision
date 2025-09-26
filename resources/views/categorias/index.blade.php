@extends('layouts.app')

@section('header')
    Gerenciar Categorias
@endsection

@section('content')
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Cabeçalho --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">📂 Suas Categorias</h2>
                <p class="mt-1 text-base text-gray-600">Organize suas categorias para facilitar seus lançamentos
                    financeiros.</p>
            </div>
            <a href="{{ route('categorias.create') }}"
                class="inline-flex items-center px-5 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition text-sm">
                <i class="fa-solid fa-plus mr-2"></i> Criar Nova Categoria
            </a>
        </div>

        {{-- Mensagens de feedback --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl shadow-sm">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl shadow-sm">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Tabela de Categorias --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nome
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Cor
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Lançamentos</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <i class="{{ $category->icon ?? 'fa-solid fa-tag' }} fa-fw text-lg"
                                        style="color: {{ $category->color ?? '#6c757d' }}"></i>
                                    <span class="text-sm font-medium text-gray-900">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full text-white"
                                    style="background-color: {{ $category->color ?? '#e9ecef' }};">
                                    {{ $category->color ?? 'Padrão' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $category->lancamentos_count }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('categorias.edit', $category) }}" class="text-primary hover:opacity-80"
                                        title="Editar">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>

                                    @if($category->lancamentos_count > 0)
                                        <button type="button" class="text-gray-300 cursor-not-allowed"
                                            title="Esta categoria não pode ser excluída pois está em uso.">
                                            <i class="fa-solid fa-lock"></i>
                                        </button>
                                    @else
                                        <form action="{{ route('categorias.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:opacity-80" title="Excluir">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-500">
                                Nenhuma categoria encontrada. Clique em <strong>"Criar Nova Categoria"</strong> para começar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection