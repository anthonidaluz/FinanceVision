@extends('layouts.app')

@section('header')
    Lançamentos
@endsection

@push('styles')
    {{-- CSS customizado necessário para o seletor de tipo (Receita/Despesa) --}}
    <style>
        .entry-type-toggle input[type="radio"]:checked+label {
            transition: all 0.2s ease-in-out;
        }

        #receita:checked+label {
            background-color: #28a745;
            /* Cor de Sucesso */
            color: white;
            border-color: #28a745;
        }

        #despesa:checked+label {
            background-color: #e74c3c;
            /* Cor de Perigo */
            color: white;
            border-color: #e74c3c;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-8">
        {{-- Mensagem de Feedback --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Formulário para Adicionar Lançamento --}}
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-xl font-semibold mb-6 border-b pb-4 text-gray-800">Adicionar Novo Lançamento</h3>
            <form action="{{ route('lancamentos.store') }}" method="POST" x-data="{ type: '{{ old('type', 'receita') }}' }">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                        <div class="entry-type-toggle flex rounded-md border border-gray-300">
                            <input @click="type = 'receita'" type="radio" id="receita" name="type" value="receita"
                                class="hidden" {{ old('type', 'receita') == 'receita' ? 'checked' : '' }}>
                            <label for="receita"
                                class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold rounded-l-md">Receita</label>
                            <input @click="type = 'despesa'" type="radio" id="despesa" name="type" value="despesa"
                                class="hidden" {{ old('type', 'receita') == 'despesa' ? 'checked' : '' }}>
                            <label for="despesa"
                                class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold rounded-r-md border-l border-gray-300">Despesa</label>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}" required
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="Ex: Salário, Supermercado">
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Valor</label>
                        <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount') }}" required
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="150.75">
                        @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Data</label>
                        <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Categoria</label>
                        <select id="category_id" name="category_id"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                            <option value="">Nenhuma</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="meta_id" class="block text-sm font-medium text-gray-700 mb-2">Vincular a Meta</label>
                        <select id="meta_id" name="meta_id"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                            <option value="">Nenhuma</option>
                            @foreach ($metas as $meta)
                                <option value="{{ $meta->id }}" {{ old('meta_id') == $meta->id ? 'selected' : '' }}>
                                    {{ $meta->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end mt-6 md:col-span-full">
                        <button type="submit"
                            class="inline-flex items-center px-8 py-3 bg-primary border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-opacity-90">Salvar</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Tabela de Histórico --}}
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Histórico de Lançamentos</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descrição</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($lancamentos as $lancamento)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $lancamento->description }}</div>
                                    <div class="text-sm text-gray-500">
                                        @if($lancamento->category)
                                            <span class="font-semibold"
                                                style="color: {{ $lancamento->category->color ?? 'inherit' }}">{{ $lancamento->category->name }}</span>
                                        @endif
                                        @if($lancamento->meta)
                                            <span class="ml-2 italic opacity-75">→ {{ $lancamento->meta->name }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($lancamento->date)->format('d/m/Y') }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $lancamento->type == 'receita' ? 'text-success' : 'text-danger' }}">
                                    {{ $lancamento->type == 'receita' ? '+' : '-' }} R$
                                    {{ number_format($lancamento->amount, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('lancamentos.edit', $lancamento) }}"
                                            class="text-primary hover:opacity-80" title="Editar"><i
                                                class="fa-solid fa-pencil"></i></a>
                                        <form action="{{ route('lancamentos.destroy', $lancamento) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger hover:opacity-80" title="Excluir"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-500">Nenhum lançamento
                                    encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection