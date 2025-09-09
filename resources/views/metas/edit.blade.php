@extends('layouts.app')

@section('header')
    Editar Meta
@endsection

@section('content')
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md max-w-2xl mx-auto">
        <form action="{{ route('metas.update', $meta) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <div class="input-group">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome da Meta</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $meta->name) }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="input-group">
                    <label for="target_amount" class="block text-sm font-medium text-gray-700">Valor Alvo (R$)</label>
                    <input type="number" step="0.01" id="target_amount" name="target_amount"
                        value="{{ old('target_amount', $meta->target_amount) }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('target_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="input-group">
                    <label for="target_date" class="block text-sm font-medium text-gray-700">Data Alvo (Opcional)</label>
                    <input type="date" id="target_date" name="target_date"
                        value="{{ old('target_date', $meta->target_date) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('target_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            {{-- Depois --}}
            <div class="flex items-center justify-end gap-4 mt-6 pt-6 border-t">
                <a href="{{ route('metas.index') }}"
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