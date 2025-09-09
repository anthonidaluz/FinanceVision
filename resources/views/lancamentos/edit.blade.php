@extends('layouts.app')

@section('header')
    Editar Lançamento
@endsection

@push('styles')
    {{-- CSS customizado para o seletor de tipo --}}
    <style>
        .entry-type-toggle input[type="radio"]:checked+label {
            transition: all 0.2s ease-in-out;
        }

        #receita:checked+label {
            background-color: #28a745;
            /* Verde */
            color: white;
            border-color: #28a745;
        }

        #despesa:checked+label {
            background-color: #e74c3c;
            /* Vermelho */
            color: white;
            border-color: #e74c3c;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md max-w-4xl mx-auto">
        <form action="{{ route('lancamentos.update', $lancamento) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                    <div class="entry-type-toggle flex rounded-md border border-gray-300">
                        <input type="radio" id="receita" name="type" value="receita" class="hidden" {{ old('type', $lancamento->type) == 'receita' ? 'checked' : '' }}>
                        <label for="receita"
                            class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold rounded-l-md">Receita</label>

                        <input type="radio" id="despesa" name="type" value="despesa" class="hidden" {{ old('type', $lancamento->type) == 'despesa' ? 'checked' : '' }}>
                        <label for="despesa"
                            class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold rounded-r-md border-l border-gray-300">Despesa</label>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <input type="text" id="description" name="description"
                        value="{{ old('description', $lancamento->description) }}" required
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('description') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Valor</label>
                    <input type="number" step="0.01" id="amount" name="amount"
                        value="{{ old('amount', $lancamento->amount) }}" required
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('amount') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Data</label>
                    <input type="date" id="date" name="date" value="{{ old('date', $lancamento->date) }}" required
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('date') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="meta_id" class="block text-sm font-medium text-gray-700 mb-2">Vincular a uma Meta
                        (Opcional)</label>
                    <select id="meta_id" name="meta_id"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option value="">Nenhuma</option>
                        @foreach ($metas as $meta)
                            <option value="{{ $meta->id }}" {{ old('meta_id', $lancamento->meta_id) == $meta->id ? 'selected' : '' }}>{{ $meta->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Depois --}}
            <div class="flex items-center justify-end gap-4 mt-6 pt-6 border-t">
                <a href="{{ route('lancamentos.index') }}"
                    class="inline-flex items-center px-6 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                    Voltar
                </a>
                <button type="submit"
                    class="inline-flex items-center px-8 py-2 bg-primary border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-opacity-90">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection