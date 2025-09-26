@extends('layouts.app')

@section('header')
    Editar Lançamento
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
<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 space-y-8">

    <h3 class="text-2xl font-bold text-gray-900 tracking-tight">✏️ Editar Lançamento</h3>

    <form action="{{ route('lancamentos.update', $lancamento) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Tipo --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo</label>
                <div class="entry-type-toggle flex rounded-lg border border-gray-300 overflow-hidden">
                    <input type="radio" id="receita" name="type" value="receita" class="hidden"
                        {{ old('type', $lancamento->type) == 'receita' ? 'checked' : '' }}>
                    <label for="receita"
                        class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-up"></i> Receita
                    </label>

                    <input type="radio" id="despesa" name="type" value="despesa" class="hidden"
                        {{ old('type', $lancamento->type) == 'despesa' ? 'checked' : '' }}>
                    <label for="despesa"
                        class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold border-l border-gray-300 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-down"></i> Despesa
                    </label>
                </div>
            </div>

            {{-- Valor --}}
            <div>
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Valor</label>
                <input type="number" step="0.01" id="amount" name="amount"
                    value="{{ old('amount', $lancamento->amount) }}" required
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Descrição --}}
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Descrição</label>
                <input type="text" id="description" name="description"
                    value="{{ old('description', $lancamento->description) }}" required
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                    placeholder="Ex: Salário, Supermercado">
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Data --}}
            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">Data</label>
                <input type="date" id="date" name="date" value="{{ old('date', $lancamento->date) }}" required
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
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $lancamento->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Meta --}}
            <div class="md:col-span-2">
                <label for="meta_id" class="block text-sm font-semibold text-gray-700 mb-2">Vincular a uma Meta (Opcional)</label>
                <select id="meta_id" name="meta_id"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                    <option value="">Nenhuma</option>
                    @foreach ($metas as $meta)
                        <option value="{{ $meta->id }}"
                            {{ old('meta_id', $lancamento->meta_id) == $meta->id ? 'selected' : '' }}>
                            {{ $meta->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Botões --}}
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t">
            <a href="{{ route('lancamentos.index') }}"
                class="inline-flex items-center px-6 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
            </a>
            <button type="submit"
                class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                <i class="fa-solid fa-check mr-2"></i> Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection