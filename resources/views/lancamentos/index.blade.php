@extends('layouts.app')

@section('header')
    Lançamentos
@endsection

@push('styles')
{{-- CSS customizado para o seletor de tipo --}}
<style>
    .entry-type-toggle input[type="radio"]:checked + label {
        transition: all 0.2s ease-in-out;
    }
    #receita:checked + label {
        background-color: #28a745; /* Verde */
        color: white;
        border-color: #28a745;
    }
    #despesa:checked + label {
        background-color: #e74c3c; /* Vermelho */
        color: white;
        border-color: #e74c3c;
    }
</style>
@endpush

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
        <h3 class="text-xl font-semibold mb-6 border-b pb-4">Adicionar Novo Lançamento</h3>
        <form action="{{ route('lancamentos.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                    <div class="entry-type-toggle flex rounded-md border border-gray-300">
                        <input type="radio" id="receita" name="type" value="receita" class="hidden" {{ old('type') == 'receita' ? 'checked' : '' }}>
                        <label for="receita" class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold rounded-l-md">Receita</label>
                        <input type="radio" id="despesa" name="type" value="despesa" class="hidden" {{ old('type', 'despesa') == 'despesa' ? 'checked' : '' }}>
                        <label for="despesa" class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold rounded-r-md border-l border-gray-300">Despesa</label>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <input type="text" id="description" name="description" value="{{ old('description') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Ex: Salário, Supermercado">
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Valor</label>
                    <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="150.75">
                    @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Data</label>
                    <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="meta_id" class="block text-sm font-medium text-gray-700 mb-2">Vincular a uma Meta (Opcional)</label>
                    <select id="meta_id" name="meta_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option value="">Nenhuma</option>
                        @foreach ($metas as $meta)
                            <option value="{{ $meta->id }}" {{ old('meta_id') == $meta->id ? 'selected' : '' }}>{{ $meta->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-8 py-3 bg-primary border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                    Salvar
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
        <h3 class="text-xl font-semibold mb-4">Histórico de Lançamentos</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lancamentos as $lancamento)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $lancamento->description }}</div>
                                <div class="text-sm text-gray-500">{{ optional($lancamento->meta)->name ?? 'Sem meta vinculada' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($lancamento->date)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $lancamento->type == 'receita' ? 'text-success' : 'text-danger' }}">
                                {{ $lancamento->type == 'receita' ? '+' : '-' }} R$ {{ number_format($lancamento->amount, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('lancamentos.edit', $lancamento) }}" class="text-primary hover:opacity-80" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                                    <form action="{{ route('lancamentos.destroy', $lancamento) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este lançamento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger hover:opacity-80" title="Excluir"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-12 text-center text-sm text-gray-500">Nenhum lançamento encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection