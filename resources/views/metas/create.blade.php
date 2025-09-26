@extends('layouts.app')

@section('header')
    Criar Nova Meta
@endsection

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 space-y-8">

        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">🎯 Criar Nova Meta</h3>

        <form action="{{ route('metas.store') }}" method="POST">
            @csrf

            <div class="space-y-6">

                {{-- Nome da Meta --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome da Meta</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                        placeholder="Ex: Viagem de Férias">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Valor Alvo --}}
                <div>
                    <label for="target_amount" class="block text-sm font-semibold text-gray-700 mb-2">Valor Alvo
                        (R$)</label>
                    <input type="number" step="0.01" id="target_amount" name="target_amount"
                        value="{{ old('target_amount') }}" required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                        placeholder="5000.00">
                    @error('target_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Data Alvo --}}
                <div>
                    <label for="target_date" class="block text-sm font-semibold text-gray-700 mb-2">Data Alvo
                        (Opcional)</label>
                    <input type="date" id="target_date" name="target_date" value="{{ old('target_date') }}"
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                    @error('target_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Botões --}}
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t">
                <a href="{{ route('metas.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                    <i class="fa-solid fa-xmark mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                    <i class="fa-solid fa-check mr-2"></i> Salvar Meta
                </button>
            </div>
        </form>
    </div>
@endsection