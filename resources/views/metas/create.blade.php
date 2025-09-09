@extends('layouts.app')

@section('header')
    Criar Nova Meta
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
            <form action="{{ route('metas.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    {{-- Campo Nome da Meta --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome da Meta</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="Ex: Viagem de Férias">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo Valor Alvo --}}
                    <div>
                        <label for="target_amount" class="block text-sm font-medium text-gray-700">Valor Alvo (R$)</label>
                        <input type="number" step="0.01" id="target_amount" name="target_amount"
                            value="{{ old('target_amount') }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="5000.00">
                        @error('target_amount')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo Data Alvo --}}
                    <div>
                        <label for="target_date" class="block text-sm font-medium text-gray-700">Data Alvo
                            (Opcional)</label>
                        <input type="date" id="target_date" name="target_date" value="{{ old('target_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        @error('target_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Botões de Ação --}}
                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t">
                    <a href="{{ route('metas.index') }}"
                        class="inline-flex items-center px-6 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition text-xs">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-2 bg-primary border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-opacity-90 text-xs">
                        Salvar Meta
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection