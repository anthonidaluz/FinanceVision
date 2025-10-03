@extends('layouts.app')

@section('header')
    Editar Categoria
@endsection

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 space-y-8">

        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">✏️ Editar Categoria</h3>

        <form action="{{ route('categorias.update', $category) }}" method="POST" x-data="{
            selectedIcon: '{{ old('icon', $category->icon ?? 'fa-solid fa-tag') }}',
            selectedColor: '{{ old('color', $category->color ?? '#3498DB') }}'
        }">
            @csrf
            @method('PUT')

            <div class="space-y-6">

                {{-- Nome da Categoria --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome da Categoria</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                        placeholder="Ex: Transporte">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Seletor de Ícones --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ícone (Opcional)</label>
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

                    <div class="grid grid-cols-4 sm:grid-cols-8 gap-3 mt-2">
                        @foreach ($icons as $icon)
                            <button type="button" @click="selectedIcon = '{{ $icon }}'"
                                :class="{ 'ring-2 ring-primary bg-blue-50': selectedIcon === '{{ $icon }}' }"
                                class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                <i class="{{ $icon }} text-xl text-gray-600"></i>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Cor da Categoria com Preview --}}
                <div>
                    <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">Cor (Opcional)</label>
                    <div class="flex items-center gap-4">
                        <input type="color" id="color" name="color" x-model="selectedColor"
                            class="p-1 h-10 w-16 border border-gray-300 rounded-md cursor-pointer">
                        <div class="flex-1 flex items-center justify-center p-3 rounded-lg"
                            :style="`background-color: ${selectedColor}`">
                            <i :class="selectedIcon" class="text-2xl text-white"></i>
                            <span class="ml-3 font-semibold text-white" x-text="selectedColor"></span>
                        </div>
                    </div>
                    @error('color') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Botões --}}
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t">
                <a href="{{ route('categorias.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                    <i class="fa-solid fa-xmark mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                    <i class="fa-solid fa-check mr-2"></i> Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection