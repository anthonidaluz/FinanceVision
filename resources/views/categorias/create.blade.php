@extends('layouts.app')

@section('header')
    Criar Nova Categoria
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
            {{-- Usamos x-data para inicializar o Alpine.js e guardar o estado do ícone e da cor --}}
            <form action="{{ route('categorias.store') }}" method="POST" x-data="{ 
                    selectedIcon: '{{ old('icon', 'fa-solid fa-tag') }}',
                    selectedColor: '{{ old('color', '#3498DB') }}'
                }">
                @csrf
                <div class="space-y-6">
                    {{-- Campo Nome da Categoria --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome da Categoria</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="Ex: Alimentação">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NOVO: Seletor Visual de Ícones --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ícone (Opcional)</label>
                        {{-- Input escondido que guardará o valor do ícone selecionado --}}
                        <input type="hidden" name="icon" x-model="selectedIcon">

                        @php
                            $icons = [
                                'fa-solid fa-burger',
                                'fa-solid fa-car',
                                'fa-solid fa-house-chimney',
                                'fa-solid fa-graduation-cap',
                                'fa-solid fa-notes-medical',
                                'fa-solid fa-cart-shopping',
                                'fa-solid fa-plane',
                                'fa-solid fa-gift'
                            ];
                        @endphp

                        <div class="mt-2 grid grid-cols-8 gap-2">
                            @foreach ($icons as $icon)
                                <button type="button" @click="selectedIcon = '{{ $icon }}'"
                                    :class="{ 'ring-2 ring-primary bg-blue-50': selectedIcon === '{{ $icon }}' }"
                                    class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                    <i class="{{ $icon }} text-xl text-gray-600"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Campo Cor com preview do ícone --}}
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Cor (Opcional)</label>
                        <div class="flex items-center gap-4 mt-1">
                            <input type="color" id="color" name="color" x-model="selectedColor"
                                class="p-1 h-10 w-16 block border border-gray-300 rounded-md cursor-pointer">
                            <div class="w-full flex items-center justify-center p-2 rounded-lg"
                                :style="`background-color: ${selectedColor}`">
                                <i :class="selectedIcon" class="text-2xl text-white"></i>
                                <span class="ml-2 font-semibold text-white" x-text="selectedColor"></span>
                            </div>
                        </div>
                        @error('color')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Botões de Ação --}}
                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t">
                    <a href="{{ route('categorias.index') }}"
                        class="inline-flex items-center px-6 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition text-xs">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-2 bg-primary border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-opacity-90 text-xs">
                        Salvar Categoria
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection