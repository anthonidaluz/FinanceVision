@extends('layouts.app')

@section('header')
    Editar Categoria
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
            <form action="{{ route('categorias.update', $category) }}" method="POST">
                @csrf
                @method('PUT') 

                <div class="space-y-6">
                    {{-- Campo Nome da Categoria --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome da Categoria</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo Ícone --}}
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700">Ícone (Opcional)</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $category->icon) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="Ex: fa-solid fa-burger">
                        <p class="text-xs text-gray-500 mt-1">Use classes do <a
                                href="https://fontawesome.com/search?o=r&m=free" target="_blank"
                                class="text-primary hover:underline">Font Awesome</a>.</p>
                        @error('icon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo Cor --}}
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Cor (Opcional)</label>
                        <input type="color" id="color" name="color" value="{{ old('color', $category->color) }}"
                            class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm">
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
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection