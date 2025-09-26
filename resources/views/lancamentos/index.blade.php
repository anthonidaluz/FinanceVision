@extends('layouts.app')

@section('header')
    Meus Lançamentos
@endsection

@push('styles')
    <style>
        .entry-type-toggle input[type="radio"]:checked+label {
            transition: all 0.2s ease-in-out;
        }

        #receita:checked+label {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        #despesa:checked+label {
            background-color: #e74c3c;
            color: white;
            border-color: #e74c3c;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-10">

        {{-- Feedback --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl shadow-sm">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Formulário --}}
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-900 tracking-tight mb-6 pb-4 border-b">💰 Adicionar Novo Lançamento</h3>

            <form action="{{ route('lancamentos.store') }}" method="POST" x-data="{ type: '{{ old('type', 'receita') }}' }">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    {{-- Tipo --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo</label>
                        <div class="entry-type-toggle flex rounded-lg border border-gray-300 overflow-hidden">
                            <input @click="type = 'receita'" type="radio" id="receita" name="type" value="receita"
                                class="hidden" {{ old('type', 'receita') == 'receita' ? 'checked' : '' }}>
                            <label for="receita"
                                class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold flex items-center justify-center gap-2">
                                <i class="fa-solid fa-arrow-up"></i> Receita
                            </label>

                            <input @click="type = 'despesa'" type="radio" id="despesa" name="type" value="despesa"
                                class="hidden" {{ old('type', 'receita') == 'despesa' ? 'checked' : '' }}>
                            <label for="despesa"
                                class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold border-l border-gray-300 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-arrow-down"></i> Despesa
                            </label>
                        </div>
                    </div>

                    {{-- Descrição --}}
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Descrição</label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="Ex: Salário, Supermercado">
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Valor --}}
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Valor</label>
                        <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount') }}" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="150.75">
                        @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Data --}}
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">Data</label>
                        <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                        @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Categoria --}}
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Categoria</label>
                        <select id="category_id" name="category_id"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                            <option value="">Nenhuma</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Meta --}}
                    <div>
                        <label for="meta_id" class="block text-sm font-semibold text-gray-700 mb-2">Vincular a Meta</label>
                        <select id="meta_id" name="meta_id"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                            <option value="">Nenhuma</option>
                            @foreach ($metas as $meta)
                                <option value="{{ $meta->id }}" {{ old('meta_id') == $meta->id ? 'selected' : '' }}>
                                    {{ $meta->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botões --}}
                    <div class="flex flex-wrap justify-end items-center gap-4 mt-6 md:col-span-full">
                        <button type="button" disabled
                            class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-500 font-semibold rounded-lg shadow-sm cursor-not-allowed hover:bg-gray-300 transition">
                            <i class="fa-solid fa-file-import mr-2"></i>
                            Importar Extrato
                        </button>

                        <button type="submit"
                            class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                            <i class="fa-solid fa-check mr-2"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>


        {{-- Tabela de Histórico --}}
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-900 tracking-tight mb-6">📁 Histórico de Lançamentos</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Descrição</th>
                            <th class="px-6 py-3 text-left font-semibold">Data</th>
                            <th class="px-6 py-3 text-left font-semibold">Valor</th>
                            <th class="px-6 py-3 text-right font-semibold">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($lancamentos as $lancamento)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        @if($lancamento->category && $lancamento->category->icon)
                                            <i class="{{ $lancamento->category->icon }} text-lg"
                                                style="color: {{ $lancamento->category->color ?? '#6c757d' }}"></i>
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $lancamento->description }}</div>
                                            <div class="text-xs text-gray-500">
                                                @if($lancamento->category)
                                                    <span class="font-semibold">{{ $lancamento->category->name }}</span>
                                                @endif
                                                @if($lancamento->meta)
                                                    <span class="ml-2 italic opacity-75">→ {{ $lancamento->meta->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    {{ \Carbon\Carbon::parse($lancamento->date)->format('d/m/Y') }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap font-semibold {{ $lancamento->type == 'receita' ? 'text-green-600' : 'text-red-500' }}">
                                    R$ {{ number_format($lancamento->amount, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('lancamentos.edit', $lancamento) }}"
                                            class="text-blue-600 hover:text-blue-800 transition" title="Editar">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('lancamentos.destroy', $lancamento) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este lançamento?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition"
                                                title="Excluir">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    Nenhum lançamento encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection