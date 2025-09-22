@extends('layouts.app')

@section('header')
    Gerenciar Categorias
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Suas Categorias</h2>
                <p class="mt-1 text-lg text-gray-600">Crie e organize as categorias para seus lançamentos.</p>
            </div>
            <a href="{{ route('categorias.create') }}"
                class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90 transition">
                Criar Nova Categoria
            </a>
        </div>

        {{-- Exibição de Mensagens de Sucesso --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Exibição de Mensagens de Erro (ADICIONADO) --}}
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cor</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lançamentos</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="{{ $category->icon ?? 'fa-solid fa-tag' }} fa-fw mr-3"
                                        style="color: {{ $category->color ?? '#6c757d' }}"></i>
                                    <span class="text-sm font-medium text-gray-900">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white"
                                    style="background-color: {{ $category->color ?? '#e9ecef' }};">
                                    {{ $category->color ?? 'Padrão' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->lancamentos_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('categorias.edit', $category) }}" class="text-primary hover:opacity-80"
                                        title="Editar">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>

                                    {{-- LÓGICA DE PROTEÇÃO (ATUALIZADA) --}}
                                    @if($category->lancamentos_count > 0)
                                        {{-- Botão desabilitado com dica --}}
                                        <button type="button" class="text-gray-300 cursor-not-allowed"
                                            title="Esta categoria não pode ser excluída pois está em uso.">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @else
                                        {{-- Formulário de exclusão funcional --}}
                                        <form action="{{ route('categorias.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger hover:opacity-80" title="Excluir">
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
                                Nenhuma categoria encontrada. Clique em "Criar Nova Categoria" para começar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection